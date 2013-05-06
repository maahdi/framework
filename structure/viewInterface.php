<?php

interface View{
    abstract function render();
    abstract function setSubmenu();
    abstract function getMenu();
}