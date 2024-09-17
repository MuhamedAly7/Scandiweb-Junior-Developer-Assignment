<?php 

namespace View\products;

use View\products\contract\ProductUI;

class DVD implements ProductUI
{
    public function getFormula()
    {
        return 'Size: ' . request('size') . ' MB';
    }

    public function getTypeName()
    {
        return 'DVD';

    }

    public function getTypeAttributes(): array
    {
        return ["size"];
    }

    public function getUI()
    {
        return  '
        <!-- size -->
        <div class="mb-3">
          <label for="size" class="form-label">Size (MB) <span class="text-danger">*</span></label>
          <input type="number" class="form-control" id="size" name="size" placeholder="Enter size in (MB)" step="any" value="<?= old("size"); ?>">
          <?php if (app()->session->hasFlash("errors")): ?>
          <p class="text-danger">
            <?= app()->session->getFlash("errors")["size"][0]; ?>
          </p>
          <?php endif; ?>
        </div>
        <p> Please, provide disc space in MB </p>
        ';
    }

}
