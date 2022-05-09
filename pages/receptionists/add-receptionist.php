<?php
/**
 * @throws Exception Emits Exception in case of an error.
 */
function add_new_receptionist(): void
{
    if (!isset($_POST['submit'])) throw new Exception("Form was not submitted correctly", 1);

}