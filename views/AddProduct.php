<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <title>Product Add</title>
  <style>
    html,
    body {
      height: 100%;
    }

    body {
      display: flex;
      flex-direction: column;
    }

    main {
      flex: 1;
    }
  </style>
  <?php


  include base_path() . 'views/partials/addproduct_header.php' ?>
</head>

<body>
  <main class="main addproduct container mt-5">
    <?php if (app()->session->hasFlash('success')): ?>
      <p class="text-success">
        <?= app()->session->getFlash('success'); ?>
      </p>
    <?php endif; ?>
    <form id="product_form" class="needs-validation" method="post" action="/addproduct">
      <div class="mb-3">
        <label for="sku" class="form-label">
          SKU <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control" id="sku" name="sku" placeholder="Enter product SKU" value="<?= old('sku'); ?>">
        <?php if (app()->session->hasFlash('errors')): ?>
          <p class="text-danger">
            <?= app()->session->getFlash('errors')['sku'][0]; ?>
          </p>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">
          Name <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" value="<?= old('name'); ?>">
        <?php if (app()->session->hasFlash('errors')): ?>
          <p class="text-danger">
            <?= app()->session->getFlash('errors')['name'][0]; ?>
          </p>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="price" class="form-label">
          Price ($) <span class="text-danger">*</span>
        </label>
        <input type="number" class="form-control" id="price" name="price" placeholder="Enter product price" step="any" value="<?= old('price'); ?>">
        <?php if (app()->session->hasFlash('errors')): ?>
          <p class="text-danger">
            <?= app()->session->getFlash('errors')['price'][0]; ?>
          </p>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="productType" class="form-label">
          Type Switcher
        </label>
        <select class="form-select" id="productType" name="type" required>
          <option value="DVD" id="DVD" <?= old('type') == 'DVD' ? 'selected' : ''; ?>>DVD</option>
          <option value="Book" id="Book" <?= old('type') == 'Book' ? 'selected' : ''; ?>>Book</option>
          <option value="Furniture" id="Furniture" <?= old('type') == 'Furniture' ? 'selected' : ''; ?>>Furniture</option>
        </select>
      </div>

      <div id="dynamic-content"></div>
    </form>

  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
  <!-- Handling dynamic-content -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      class ProductType {
        constructor(type) {
          this.type = type;
        }

        renderFormFields() {
          return '';
        }
      }

      class DVD extends ProductType {
        renderFormFields() {
          return `
            <!-- size -->
            <div class="mb-3">
              <label for="size" class="form-label">Size (MB) <span class="text-danger">*</span></label>
              <input type="number" class="form-control" id="size" name="size" placeholder="Enter size in (MB)" step="any" value="<?= old('size'); ?>">
              <?php if (app()->session->hasFlash('errors')): ?>
              <p class="text-danger">
                <?= app()->session->getFlash('errors')['size'][0]; ?>
              </p>
              <?php endif; ?>
            </div>
            <p> Please, provide disc space in MB </p>
          `;
        }
      }

      class Book extends ProductType {
        renderFormFields() {
          return `
            <!-- weight -->
            <div class="mb-3">
              <label for="weight" class="form-label">Weight (kg) <span class="text-danger">*</span></label>
              <input type="number" class="form-control" id="weight" name="weight" placeholder="Enter weight in (kg)" step="any" value="<?= old('weight'); ?>">
              <?php if (app()->session->hasFlash('errors')): ?>
              <p class="text-danger">
                <?= app()->session->getFlash('errors')['weight'][0]; ?>
              </p>
              <?php endif; ?>
            </div>
            <p> Please, provide book weight in KG </p>
          `;
        }
      }

      class Furniture extends ProductType {
        renderFormFields() {
          return `
            <!-- dimensions -->
            <div class="mb-3">
              <label for="height" class="form-label">Height (CM) <span class="text-danger">*</span></label>
              <input type="number" class="form-control" id="height" name="height" placeholder="Enter height in (cm)" step="any" value="<?= old('height'); ?>">
              <?php if (app()->session->hasFlash('errors')): ?>
              <p class="text-danger">
                <?= app()->session->getFlash('errors')['height'][0]; ?>
              </p>
              <?php endif; ?>
            </div>

            <div class="mb-3">
              <label for="width" class="form-label">Width (CM) <span class="text-danger">*</span></label>
              <input type="number" class="form-control" id="width" name="width" placeholder="Enter width in (cm)" step="any" value="<?= old('width'); ?>">
              <?php if (app()->session->hasFlash('errors')): ?>
              <p class="text-danger">
                <?= app()->session->getFlash('errors')['width'][0]; ?>
              </p>
              <?php endif; ?>
            </div>

            <div class="mb-3">
              <label for="length" class="form-label">Length (CM) <span class="text-danger">*</span></label>
              <input type="number" class="form-control" id="length" name="length" placeholder="Enter length in (cm)" step="any" value="<?= old('length'); ?>">
              <?php if (app()->session->hasFlash('errors')): ?>
              <p class="text-danger">
                <?= app()->session->getFlash('errors')['length'][0]; ?>
              </p>
              <?php endif; ?>
            </div>
            <p> Please, provide dimensions in CM </p>
          `;
        }
      }

      class ProductTypeFactory {
        static createProductType(type) {
          switch (type) {
            case 'DVD':
              return new DVD(type);
            case 'Book':
              return new Book(type);
            case 'Furniture':
              return new Furniture(type);
            default:
              return new ProductType(type);
          }
        }
      }

      const productType = document.getElementById('productType');
      const dynamicContent = document.getElementById('dynamic-content');

      function updateForm(selectedType = null) {
        const type = selectedType || productType.value;
        const productTypeInstance = ProductTypeFactory.createProductType(type);
        dynamicContent.innerHTML = productTypeInstance.renderFormFields();
      }

      updateForm('<?= old('type'); ?>' || null);
      productType.addEventListener('change', () => updateForm());
    });
  </script>

  <footer class="bg-light py-3 mt-5">
    <div class="container">
      <div class="row">
        <div class="col text-start">
          <span>Scandiweb Test assignment</span>
        </div>
        <div class="col text-end">
          <span>&copy; 2024 Mohamed Ali</span>
        </div>
      </div>
    </div>
  </footer>
</body>

</html>