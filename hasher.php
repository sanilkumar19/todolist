<?php
$hashed_Pass = password_hash("User1",PASSWORD_DEFAULT);
echo password_verify("User1",$hashed_Pass);