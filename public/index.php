<?php

/**
 * !HARDJUNIOR
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * *@package        HARDJUNIOR
 * *@author        Zas Dev Team
 * *@copyright    Copyright (c) 2008 - 2014, Hardjunior, Inc. (https://faustino.pt/)
 * *@license    https://opensource.org/licenses/MIT    MIT License
 * *@link    https://faustino.pt
 * *@since    Version 1.0.0
 * *@filesource
 */
ini_set("log_errors", "On");
ini_set("error_log", "./error_jr.log");
ob_start();

// try {

/*
    * --------------------------------------------------------------------
    * LOAD THE BOOTSTRAP FILE
    * --------------------------------------------------------------------
    */
require_once dirname(__DIR__, 1) . "/vendor/autoload.php";

// } catch (\Exception $e) {
//     throw new Exception("Não é possível continuar!" . $e->getMessage(), 1);
// }

/*
 * --------------------------------------------------------------------
 * ROUTE FILE SYSTEM
 * --------------------------------------------------------------------
 *
 * And away we go...
 */

ob_end_flush();

exit;
