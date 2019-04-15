<?php

/**
 * @file
 * Contains \Drupal\cga_initiatives\Plugin\migrate\process\FileImport.
 */
namespace Drupal\cga_initiatives\Plugin\migrate\process;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;

/**
 * Import a file as a side-effect of a migration.
 *
 * @MigrateProcessPlugin(
 *   id = "file_import"
 * )
 */
class FileImport extends ProcessPluginBase {
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    if (empty($value)) {
      // Skip this item if there's no URL.
      //throw new MigrateSkipProcessException();
      print "no url in $value\n";
      return 0;
    }

    // Save the file, return its ID.
    if(substr( $value, 0, 4 ) != "http") { 
      //$value = "http://maxfund.redbike.org/" . $value;
    }
    $file = system_retrieve_file($value, 'public://', TRUE, FILE_EXISTS_REPLACE);
    if($file) {
      return $file->id();
    }
    else {
      print "no luck with $value\n";
      return 0; 
    }
  }
}

