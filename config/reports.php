<?php

/**
 * Jasper reports configuration file
 * Server, username and password are mandatory
 * 
 */

return [
  /**
   * Server URi
   */
  'server' => env('RPT_SERVER', 'http://localhost:8080/jasperserver'),

  /**
   * Jasper Repors User Name
   */
  'username' => env('RPT_USERNAME', 'jasperadmin'),

  /**
   * Jasper Reports User's password
   */
  'password' => env('RPT_PASSWORD', 'jasperadmin'),
  
  /** 
   * jasper Reports image storage path
   */
  'server_storage' => env('SVR_IMG_STORAGE', 'http://localhost:8000/storage')
];