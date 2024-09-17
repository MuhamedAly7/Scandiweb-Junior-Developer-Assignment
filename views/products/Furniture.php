<?php

namespace View\products;

use View\products\contract\ProductUI;

class Furniture implements ProductUI
{
    public function getFormula()
    {
        return  'Dimension: ' . request('height') . 'x' . request('width') . 'x' . request('length');
    }

    public function getTypeName()
    {
        return 'Furniture';
    }

    public function getTypeAttributes(): array
    {
        return ['height', 'width', 'length'];
    }

    public function getUI()
    {
        return '<!-- dimensions -->
        <div class="mb-3">
        <label for="height" class="form-label">Height (CM) <span class="text-danger">*</span></label>
        <input type="number" class="form-control" id="height" name="height" placeholder="Enter height in (cm)" step="any" value="<?= old("height"); ?>">
        <?php if (app()->session->hasFlash("errors")): ?>
        <p class="text-danger">
          <?= app()->session->getFlash("errors")["height"][0]; ?>
        </p>
        <?php endif; ?>
        </div>
        <div class="mb-3">
          <label for="width" class="form-label">Width (CM) <span class="text-danger">*</span></label>
          <input type="number" class="form-control" id="width" name="width" placeholder="Enter width in (cm)" step="any" value="<?= old("width"); ?>">
          <?php if (app()->session->hasFlash("errors")): ?>
          <p class="text-danger">
            <?= app()->session->getFlash("errors")["width"][0]; ?>
          </p>
          <?php endif; ?>
        </div>
        <div class="mb-3">
          <label for="length" class="form-label">Length (CM) <span class="text-danger">*</span></label>
          <input type="number" class="form-control" id="length" name="length" placeholder="Enter length in (cm)" step="any" value="<?= old("length"); ?>">
          <?php if (app()->session->hasFlash("errors")): ?>
          <p class="text-danger">
            <?= app()->session->getFlash("errors")["length"][0]; ?>
          </p>
          <?php endif; ?>
        </div>
        <p> Please, provide dimensions in CM </p>
        ';
    }
}