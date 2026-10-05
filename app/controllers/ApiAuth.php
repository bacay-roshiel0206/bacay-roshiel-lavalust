<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiAuth extends Controller
{
    public function __construct()
    {
        parent::__construct();

        // Load API library
        $this->call->library('api');

        // Load default database connection
        $this->call->database();
    }

    /**
     * POST /api/auth/login
     */
    public function login()
    {
        // Only POST is allowed
        $this->api->require_method('POST');

        // Rate limit
        $this->api->rate_limit();

        // Get JSON request body
        $data = $this->api->body();

        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';

        // Validate input
        if (empty($username) || empty($password)) {
            $this->api->respond_error(
                'Username and password are required',
                422
            );
            return;
        }

        /*
         * Find user in auth table
         *
         * Columns:
         * id
         * username
         * password
         * created_at
         */
        $query = $this->db
            ->table('auth')
            ->where('username', $username)
            ->get();

        $user = null;

        /*
         * Handle database result
         */
        if (is_array($query) && !empty($query)) {

            // Single associative row
            if (isset($query['username'])) {
                $user = $query;
            } else {
                // Multiple rows
                $user = reset($query);
            }
        }

        /*
         * Check username and password
         */
        if (
            !$user ||
            !isset($user['password']) ||
            !password_verify($password, $user['password'])
        ) {
            $this->api->respond_error(
                'Invalid username or password',
                401
            );
            return;
        }

        /*
         * JWT user data
         *
         * Your current auth table does not have
         * a role column.
         */
        $user_data = [
            'id'     => $user['id'],
            'role'   => 'user',
            'scopes' => ['read', 'write']
        ];

        /*
         * Generate access and refresh tokens
         */
        $tokens = $this->api->issue_tokens($user_data);

        /*
         * Successful response
         */
        $this->api->respond([
            'status'  => 200,
            'message' => 'Login successful',

            'user' => [
                'id'       => $user['id'],
                'username' => $user['username'],
                'role'     => 'user'
            ],

            'tokens' => $tokens

        ], 200);
    }

    /**
     * POST /api/auth/refresh
     */
    public function refresh()
    {
        $this->api->require_method('POST');

        $this->api->rate_limit();

        $data = $this->api->body();

        $refresh_token = $data['refresh_token'] ?? '';

        if (empty($refresh_token)) {
            $this->api->respond_error(
                'Refresh token is required',
                422
            );
            return;
        }

        $this->api->refresh_access_token($refresh_token);
    }

    /**
     * POST /api/auth/logout
     */
    public function logout()
    {
        $this->api->require_method('POST');

        $this->api->rate_limit();

        $data = $this->api->body();

        $refresh_token = $data['refresh_token'] ?? '';

        if (empty($refresh_token)) {
            $this->api->respond_error(
                'Refresh token is required',
                422
            );
            return;
        }

        $this->api->revoke_refresh_token($refresh_token);

        $this->api->respond([
            'status'  => 200,
            'message' => 'Logout successful'
        ], 200);
    }
}