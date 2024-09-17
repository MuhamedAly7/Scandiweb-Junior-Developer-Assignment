<?php

namespace View\products\contract;

interface ProductUI
{
    public function getFormula();
    public function getTypeName();
    public function getTypeAttributes() : array;
    public function getUI();
}