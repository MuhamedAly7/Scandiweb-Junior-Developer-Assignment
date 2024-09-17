<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Product List</title>

    <style>
      /* Ensure body takes up full height */
      html, body {
        height: 100%;
      }

      /* Flexbox layout to push the footer to the bottom */
      body {
        display: flex;
        flex-direction: column;
      }

      /* Content area flex grows to fill available space */
      .container {
        flex: 1;
      }

      footer {
        background-color: #f8f9fa;
        padding: 15px 0;
        margin-top: auto;
      }
    </style>

    <?php include base_path() . 'views/partials/productlist_header.php' ?>

  </head>
  <body>
    <div class="container mt-5">
        <form method="POST" action="/" id="delete-product">
            <div class="row">
                <?php $products = get_all() ?>
                <?php foreach ($products as $product): ?>
                  <div class="col-md-4 mb-4">
                    <div class="card h-100 text-center shadow-lg" style="border-radius: 15px; overflow: hidden;">
                      <div class="card-body">
                        <div style="position: absolute; top: 10px; left: 10px;">
                          <input type="checkbox" class=".delete-checkbox" name="selected_products[]" value="<?= $product->product_form; ?>" style="transform: scale(1.2);">
                        </div>
                        <div class="mb-3">
                        </div>
                        <h5 class="card-title text-uppercase" style="font-weight: bold;"><?= $product->sku ?></h5>
                        <p class="card-text" style="color: #555;"><?= $product->name ?></p>
                        <p class="card-text" style="color: #28a745; font-size: 1.2em;"><?= number_format($product->price, 2) ?> $</p>
                        <p class="card-text" style="font-size: 1.3em;"><?=$product->attribute?></p>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
            </div>
        </form>
    </div>
    <footer>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
