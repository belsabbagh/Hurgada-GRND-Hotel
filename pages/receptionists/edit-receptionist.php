<?php

/**
 * @throws Exception Emits Exception if error occurs.
 */
function edit_receptionist(): void
{
    if (!($_SERVER['REQUEST_METHOD'] == 'POST')) throw new RuntimeException("Form was not submitted correctly", 1);

}