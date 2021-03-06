<?php

namespace Drupal\webform\Tests;

use Drupal\webform\Entity\Webform;

/**
 * Tests for webform submission webform.
 *
 * @group Webform
 */
class WebformSubmissionFormTest extends WebformTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  protected static $modules = ['system', 'user', 'webform', 'webform_test'];

  /**
   * Tests prepare elements.
   */
  public function testForm() {
    /* Test form#validate webform handling */
    $webform_validate = Webform::load('test_form_validate');
    $this->postSubmission($webform_validate, [], t('Submit'));
    $this->assertRaw('Custom element is required.');

    $this->postSubmission($webform_validate, ['custom' => 'value'], t('Submit'));
    $this->assertNoRaw('Custom element is required.');
  }

}
