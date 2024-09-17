<?php

namespace View\products;

use View\products\contract\ProductUI;

class Book implements ProductUI
{
    public function getFormula()
    {
        return 'Weight: ' . request('weight') . ' KG';
    }

    public function getTypeName()
    {
        return 'Book';
    }

    public function getTypeAttributes(): array
    {
        return ['weight'];
    }

    public function getUI()
    {
        return '<!-- weight -->
        <div class="mb-3">
          <label for="weight" class="form-label">Weight (kg) <span class="text-danger">*</span></label>
          <input type="number" class="form-control" id="weight" name="weight" placeholder="Enter weight in (kg)" step="any" value="<?= old("weight"); ?>">
          <?php if (app()->session->hasFlash("errors")): ?>
          <p class="text-danger">
            <?= app()->session->getFlash("errors")["weight"][0]; ?>
          </p>
          <?php endif; ?>
        </div>
        <p> Please, provide book weight in KG </p>
        ';
    }
}
