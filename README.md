<p align="center"><a href="https://naykel.com.au" target="_blank"><img src="https://avatars0.githubusercontent.com/u/32632005?s=460&u=d1df6f6e0bf29668f8a4845271e9be8c9b96ed83&v=4" width="120"></a></p>

# NAYKEL Web Application

## Component Structure and Responsibilities

- `ProductCreateEdit` focuses on form management for individual products.
- `ProductIndex` handles listing and displaying products.
- `ProductFormObject` centralises form-related logic and validation.

1. **`ProductCreateEdit` Component**:
    - **Purpose**: Handles the creation and editing of `Product` models.
    - **Responsibilities**:
        - Manages the `ProductFormObject` form object for creating or editing
          products.
        - Initialises the form with either a new model or a factory-generated
          model.
        - Provides functionality to reset the form.

2. **`ProductIndex` Component**:
    - **Purpose**: Displays a paginated and sortable list of `Product` models.
    - **Responsibilities**:
        - Manages pagination and sorting of the product list.
        - Responds to the `model-saved` event to refresh the component and reset
          pagination.
        - Prepares data for rendering by applying sorting and pagination to the
          `Product` query.

3. **`ProductFormObject` Form Object**:
    - **Purpose**: Encapsulates the form logic and validation for `Product`
      models.
    - **Responsibilities**:
        - Defines and validates form fields such as `title`, `start_date`,
          `end_date`, and `related_product_id`.
        - Initialises the form with a given `Product` model.
        - Provides a method to create a new `Product` model with default or
          provided data.
