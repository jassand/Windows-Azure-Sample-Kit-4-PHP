<?php
/**
 *    Copyright 2011 Microsoft Corporation
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * @category  Microsoft
 * @package   DealOfTheDay
 * @author    Ben Lobaugh <a-beloba@microsoft.com>
 * @copyright 2011 Copyright Microsoft Corporation. All Rights Reserved
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 **/
// This file must be called from include.php for it to function properly


// Ensure all our tables exist
$table->createTableIfNotExists('Data');
$table->createTableIfNotExists('Content');
$table->createTableIfNotExists('Comment');
$table->createTableIfNotExists('Product');
$table->createTableIfNotExists('Session');
$table->createTableIfNotExists('Redemption'); // holds a copy of the created codes. 3rd party sets redemption status
$table->createTableIfNotExists('Log'); // specific for the app only

// Ensure queue exists
//$queue->createQueueIfNotExists('comment');
$queue->createQueueIfNotExists('code');
$queue->createQueueIfNotExists('worklist');


// Ensure blob storage exists
$blob->createContainerIfNotExists('product');

// Ensure blob container has public access to blob
$blob->setContainerAcl('product', Microsoft_WindowsAzure_Storage_Blob::ACL_PUBLIC_BLOB);

// Ensure blob storage exists
$blob->createContainerIfNotExists('assets');

// Ensure blob container has public access to blob
$blob->setContainerAcl('assets', Microsoft_WindowsAzure_Storage_Blob::ACL_PUBLIC_BLOB);



// Make sure the SiteStatus Data entity exists
try {
    $d = new Data('Data', 'SiteStatus');
    $d->Value = 'Paused'; // defaults to paused
    $table->insertEntity('Data', $d);
} catch (Exception $e) { /* don't really care. we got what we needed */ }

// Play attempts
try {
    $d = new Data('Data', 'PlayAttempts');
    $d->Value = '0'; // defaults to paused
    $table->insertEntity('Data', $d);
} catch (Exception $e) { /* don't really care. we got what we needed */ }

// Number of running roles
try {
    $d = new Data('Data', 'NumWebRoles');
    $d->Value = '1'; // defaults to paused
    $table->insertEntity('Data', $d);
} catch (Exception $e) { /* don't really care. we got what we needed */ }

// Codes given out
try {
    $d = new Data('Data', 'CodesGivenOut');
    $d->Value = 'Paused'; // defaults to paused
    $table->insertEntity('Data', $d);
} catch (Exception $e) { /* don't really care. we got what we needed */ }

// Vendor confirmed codes
try {
    $d = new Data('Data', 'VendorConfirmed');
    $d->Value = '0'; // defaults to paused
    $table->insertEntity('Data', $d);
} catch (Exception $e) { /* don't really care. we got what we needed */ }

// Deleted comments for vulgarity or spam
try {
    $d = new Data('Data', 'DeletedComments');
    $d->Value = '0'; // defaults to paused
    $table->insertEntity('Data', $d);
} catch (Exception $e) { /* don't really care. we got what we needed */ }

// The timestamp for the product furthest in the future
try {
    $d = new Data('Data', 'LastCodeTimeSlot');
    $d->Value = '0'; // defaults to paused
    $table->insertEntity('Data', $d);
} catch (Exception $e) { /* don't really care. we got what we needed */ }


// admin auth code
try {
    $d = new Data('Data', 'Auth');
    $d->Value = 'Abc.123'; // defaults to paused
    $table->insertEntity('Data', $d);
} catch (Exception $e) { /* don't really care. we got what we needed */ }