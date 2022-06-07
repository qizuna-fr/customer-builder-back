<?php

namespace App\Tests;

use App\Interfaces\CustomerInterface;
use App\Interfaces\GitFileInterface;
use App\Interfaces\ImaginaryFileInterface;
use App\Services\CRMService;
use App\Services\CSSManagementService;
use App\Services\FormattingTextService;
use App\Services\ImaginaryService;
use App\Services\BillingService;
use App\Services\Dummy\DummyCustomer;
use App\Services\Stub\CRMServiceStub;
use App\Services\Stub\GitServiceStub;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ServicesTest extends WebTestCase
{

    public function testController(): void
    {
        $client = static::createClient();
        $client->request('GET', '/qizuna');
        
        $this->assertSame($client->getResponse()->getContent(), "qizuna");
    }

    public function testLowerCaseBeforeDeleteSpace(): void
    {
        $formatText = new FormattingTextService();
        $text = 'Mulhouse';
        $formatText->deleteSpace($text);
        $this->assertTrue($formatText->spyDeleteSpace);
    }

    public function testCSSManagementServices(): void
    {
        $cssManagement = new CSSManagementService();
        $text = "title";

        $textFont = "Open Sans";
        $cssManagement->editFont($text, $textFont);
        $this->assertTrue($cssManagement->spyFont);

        $textStyle = "capitalize";
        $cssManagement->editStyle($text, $textStyle);
        $this->assertTrue($cssManagement->spyStyle);

        $textColor = "bold";
        $cssManagement->editColor($text, $textColor);
        $this->assertTrue($cssManagement->spyColor);
    }

    public function testImaginaryPingBeforeConnect(): void
    {
        $imaginary = new ImaginaryService();
        $imaginary->connect();
        $this->assertTrue($imaginary->spyPing);
    }

    public function testImaginaryServiceSuccessfulConnection(): void
    {
        $imaginary = new ImaginaryService();
        $this->assertSame($imaginary->connect(), 'Connected');
    }

    public function testDisconnectionFromImaginary(): void
    {
        $imaginary = new ImaginaryService();
        $this->assertSame($imaginary->disconnect(), 'Disconnected');
    }

    public function testConnectionToImaginaryBeforeResizingImage(): void
    {
        $imaginary = new ImaginaryService();
        $file = $this->createMock(ImaginaryFileInterface::class);
        $height  = 50;
        $width = 50;
        $imaginary->resizeImage($file, $height , $width);
        $this->assertTrue($imaginary->spyResize);
    }

    public function testResizeImageSuccessfull(): void
    {
        $imaginary = new ImaginaryService();
        $file = $this->createMock(ImaginaryFileInterface::class);
        $height  = 150;
        $width = 150;
        $imaginary->resizeImage($file, $height , $width);
        $this->assertTrue($imaginary->spyResize);

        // Fonctionnel ???
        // $this->assertEquals($file->getHeight(), $height );
        // $this->assertEquals($file->getWidth(), $width);
    }

    public function testConnectionToImaginaryBeforeConvertFile(): void
    {
        $imaginary = new ImaginaryService();
        $file = $this->createMock(ImaginaryFileInterface::class);
        $extension = ".jpg";
        $imaginary->convertFile($file, $extension);
        $this->assertTrue($imaginary->spyConvert);
    }

    public function testConvertFileSuccessfull(): void
    {
        $imaginary = new ImaginaryService();
        $file = $this->createMock(ImaginaryFileInterface::class);
        $extension = ".jpg";
        $imaginary->convertFile($file, $extension);
        $this->assertTrue($imaginary->spyConvert);

        // Fonctionnel ???
        // $this->assertEquals($file->getExtension(), $extension);
    }

    public function testPingBeforeGitConnection(): void
    {
        $github = new GitServiceStub();
        $github->connect();
        $this->assertTrue($github->spyPing);
    }

    public function testGitServiceSuccessfullConnection(): void
    {
        $github = new GitServiceStub();
        $this->assertSame($github->connect(), 'Connected');
    }

    public function testDisconnectionFromGit(): void
    {
        $github = new GitServiceStub();
        $this->assertSame($github->disconnect(), 'Disconnected');
    }

    public function testConnectToGitBeforeAdd(): void
    {
        $github = new GitServiceStub();
        $file = $this->createMock(GitFileInterface::class);
        $github->add($file, "mybranch");

        $this->assertTrue($github->spyHasCheckConnection);
    }

    public function testGitAddBeforeCommit(): void
    {
        $github = new GitServiceStub();
        $branchName = "myBranch";
        $message = "commit message";
        $github->commit($branchName, $message);
        $this->assertTrue($github->spyCheckAdd);
    }

    public function testGitCommitBeforePush(): void
    {
        $github = new GitServiceStub();
        $file = $this->createMock(GitFileInterface::class);
        $branchName = "myBranch";
        $message = "commit message";
        $github->push($file, $branchName, $message);
        $this->assertTrue($github->spyCheckCommit);
    }

    public function testCRMPingBeforeConnection(): void
    {
        $hubspot = new CRMServiceStub();
        $hubspot->connect();
        $this->assertTrue($hubspot->spyConnect);
    }

    public function testCRMSuccessfullConnection(): void
    {
        $hubspot = new CRMServiceStub();
        $this->assertSame($hubspot->connect(), 'Connected');
    }

    public function testDisconnectionFromCRM(): void
    {
        $hubspot = new CRMServiceStub();
        $this->assertSame($hubspot->disconnect(), 'Disconnected');
    }

    public function testIfCRMClientExistBeforeCreation(): void
    {
        $hubspot = new CRMServiceStub();
        $customer = $this->createMock(CustomerInterface::class);
        $hubspot->connect();
        $hubspot->createCustomer($customer);
        $this->assertTrue($hubspot->spyCheckExist);
    }

    public function testBillingConnect()
    {
        $billing = new BillingService();
        $this->assertTrue($billing->connect());
    }

    public function testBillingDisConnect()
    {
        $billing = new BillingService();
        $this->assertTrue($billing->disconnect());
    }

    public function testBillingCreate()
    {
        $customer = new DummyCustomer();
        $billing = new BillingService();

        $this->assertTrue($billing->create($customer));
        $this->expectException("Client yet created..");
    }

    public function testBillingSubmission()
    {
        $customer = new DummyCustomer();
        $billing = new BillingService();

        $this->assertTrue($billing->subscribe($customer));
    }

    public function testIsThisCustomerYetCreated()
    {
        $customer = new DummyCustomer();
        $billing = new BillingService();

        $this->assertTrue($billing->isThisCustomerYetCreated($customer));
    }


    public function testHasCustomerYetSubscribe()
    {
        $customer = new DummyCustomer();
        $billing = new BillingService();

        $this->assertTrue($billing->hasCustomerYetSubscribe($customer));
    }
}
