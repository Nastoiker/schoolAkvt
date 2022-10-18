<?php
 $dbc = mysqli_connect('localhost', 'root', '', 'website') or die('error' . mysqli_connect_error());
 mysqli_set_charset($dbc, 'UTF-8');