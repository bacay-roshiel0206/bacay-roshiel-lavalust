<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Product API Controller
 */
class ProductApi extends Controller
{
    protected $api;
    protected $Product_model;

    public function __construct()
    {
        parent::__construct();

        // Load API library
        $this->api = load_class('Api', 'libraries');

        // Load Product model
        $this->Product_model = $this->call->model('Product_model');
    }

    /**
     * GET /api/products
     * Display all products
     *
     * Authentication required
     */
    public function index()
    {
        $this->api->require_method('GET');

        // Require JWT authentication
        $user = $this->api->require_jwt();

        try {

            $products = $this->Product_model->all();

            $this->api->respond([
                'status' => 200,
                'message' => 'Products retrieved successfully',
                'data' => $products
            ], 200);

        } catch (Exception $e) {

            $this->api->respond([
                'status' => 500,
                'message' => 'Failed to retrieve products',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * GET /api/products/{id}
     * Display one product
     *
     * Authentication required
     */
    public function show($id)
    {
        $this->api->require_method('GET');

        // Require JWT authentication
        $user = $this->api->require_jwt();

        try {

            $product = $this->Product_model->find($id);

            if (!$product) {
                $this->api->respond([
                    'status' => 404,
                    'message' => 'Product not found',
                    'data' => null
                ], 404);

                return;
            }

            $this->api->respond([
                'status' => 200,
                'message' => 'Product retrieved successfully',
                'data' => $product
            ], 200);

        } catch (Exception $e) {

            $this->api->respond([
                'status' => 500,
                'message' => 'Failed to retrieve product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * POST /api/products
     * Create a new product
     *
     * Authentication required
     */
    public function store()
    {
        $this->api->require_method('POST');

        // Require JWT authentication
        $user = $this->api->require_jwt();

        try {

            $data = $this->api->body();

            if (empty($data)) {
                $this->api->respond_error(
                    'Request body is required',
                    422
                );
                return;
            }

            if (empty($data['product_name'])) {
                $this->api->respond_error(
                    'Product name is required',
                    422
                );
                return;
            }

            $insertData = [
                'product_name' => $data['product_name'],
                'description'  => $data['description'] ?? '',
                'price'        => $data['price'] ?? 0,
                'quantity'     => $data['quantity'] ?? 0
            ];

            $inserted = $this->Product_model->insert($insertData);

            if ($inserted) {

                $this->api->respond([
                    'status' => 201,
                    'message' => 'Product created successfully',
                    'data' => $insertData
                ], 201);

                return;
            }

            $this->api->respond_error(
                'Failed to create product',
                500
            );

        } catch (Exception $e) {

            $this->api->respond([
                'status' => 500,
                'message' => 'Failed to create product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * PUT /api/products/{id}
     * Update an existing product
     *
     * Authentication required
     */
    public function update($id)
    {
        $this->api->require_method('PUT');

        // Require JWT authentication
        $user = $this->api->require_jwt();

        try {

            $product = $this->Product_model->find($id);

            if (!$product) {
                $this->api->respond([
                    'status' => 404,
                    'message' => 'Product not found'
                ], 404);

                return;
            }

            $data = $this->api->body();

            if (empty($data)) {
                $this->api->respond_error(
                    'Request body is required',
                    422
                );
                return;
            }

            $updateData = [];

            if (isset($data['product_name'])) {
                $updateData['product_name'] = $data['product_name'];
            }

            if (isset($data['description'])) {
                $updateData['description'] = $data['description'];
            }

            if (isset($data['price'])) {
                $updateData['price'] = $data['price'];
            }

            if (isset($data['quantity'])) {
                $updateData['quantity'] = $data['quantity'];
            }

            if (empty($updateData)) {
                $this->api->respond_error(
                    'No valid fields to update',
                    422
                );
                return;
            }

            $updated = $this->Product_model->update($id, $updateData);

            if ($updated) {

                $updatedProduct = $this->Product_model->find($id);

                $this->api->respond([
                    'status' => 200,
                    'message' => 'Product updated successfully',
                    'data' => $updatedProduct
                ], 200);

                return;
            }

            $this->api->respond_error(
                'Failed to update product',
                500
            );

        } catch (Exception $e) {

            $this->api->respond([
                'status' => 500,
                'message' => 'Failed to update product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * PATCH /api/products/{id}
     * Partially update a product
     *
     * Authentication required
     */
    public function patch($id)
    {
        $this->api->require_method('PATCH');

        // Require JWT authentication
        $user = $this->api->require_jwt();

        try {

            $product = $this->Product_model->find($id);

            if (!$product) {
                $this->api->respond([
                    'status' => 404,
                    'message' => 'Product not found'
                ], 404);

                return;
            }

            $data = $this->api->body();

            if (empty($data)) {
                $this->api->respond_error(
                    'Request body is required',
                    422
                );
                return;
            }

            $updateData = [];

            if (isset($data['product_name'])) {
                $updateData['product_name'] = $data['product_name'];
            }

            if (isset($data['description'])) {
                $updateData['description'] = $data['description'];
            }

            if (isset($data['price'])) {
                $updateData['price'] = $data['price'];
            }

            if (isset($data['quantity'])) {
                $updateData['quantity'] = $data['quantity'];
            }

            if (empty($updateData)) {
                $this->api->respond_error(
                    'No valid fields to update',
                    422
                );
                return;
            }

            $updated = $this->Product_model->update($id, $updateData);

            if ($updated) {

                $updatedProduct = $this->Product_model->find($id);

                $this->api->respond([
                    'status' => 200,
                    'message' => 'Product updated successfully',
                    'data' => $updatedProduct
                ], 200);

                return;
            }

            $this->api->respond_error(
                'Failed to update product',
                500
            );

        } catch (Exception $e) {

            $this->api->respond([
                'status' => 500,
                'message' => 'Failed to update product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * DELETE /api/products/{id}
     * Delete an existing product
     *
     * Authentication required
     */
    public function delete($id)
    {
        $this->api->require_method('DELETE');

        // Require JWT authentication
        $user = $this->api->require_jwt();

        try {

            $product = $this->Product_model->find($id);

            if (!$product) {
                $this->api->respond([
                    'status' => 404,
                    'message' => 'Product not found'
                ], 404);

                return;
            }

            $deleted = $this->Product_model->delete($id);

            if ($deleted) {

                $this->api->respond([
                    'status' => 200,
                    'message' => 'Product deleted successfully',
                    'data' => [
                        'id' => $id
                    ]
                ], 200);

                return;
            }

            $this->api->respond_error(
                'Failed to delete product',
                500
            );

        } catch (Exception $e) {

            $this->api->respond([
                'status' => 500,
                'message' => 'Failed to delete product',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}