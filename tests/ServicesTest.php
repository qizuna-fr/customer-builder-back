<?php

namespace App\Tests;

use App\Interfaces\CustomerInterface;
use App\Interfaces\GitFileInterface;
use App\Interfaces\ImaginaryFileInterface;
use App\Services\CRMService;
use App\Services\CSSManagementService;
use App\Services\FormattingTextService;
use App\Services\GitService;
use App\Services\ImaginaryService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ServicesTest extends WebTestCase
{

    // public function testFormatTextIsCalled(): void
    // {
    //     $client = static::createClient();
    //     $client->request('GET', '/qizuna');
    // }

    public function testLowerCaseBeforeDeleteSpace(): void
    {
        $formatText = new FormattingTextService;
        $text = 'Mulhouse';
        $formatText->deleteSpace($text);
        $this->assertTrue($formatText->spyDeleteSpace);
    }

    public function testCSSManagementServices(): void
    {
        $cssManagement = new CSSManagementService;
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
        $imaginary = new ImaginaryService;
        $imaginary->connect();
        $this->assertTrue($imaginary->spyPing);
    }

    public function testImaginaryServiceSuccessfulConnection(): void
    {
        $imaginary = new ImaginaryService;
        $this->assertSame($imaginary->connect(), 'Connected');
    }

    public function testDisconnectionFromImaginary(): void
    {
        $imaginary = new ImaginaryService;
        $this->assertSame($imaginary->disconnect(), 'Disconnected');
    }

    public function testConnectionToImaginaryBeforeResizingImage(): void
    {
        $imaginary = new ImaginaryService;
        // $file = new DummyImaginaryFile;
        $file = $this->createMock(ImaginaryFileInterface::class);
        $hight = 50;
        $width = 50;
        $imaginary->resizeImage($file, $hight, $width);
        $this->assertTrue($imaginary->spyResize);
    }

    public function testResizeImageSuccessfull(): void
    {
        $imaginary = new ImaginaryService;
        // $file = new DummyImaginaryFile;
        $file = $this->createMock(ImaginaryFileInterface::class);
        $hight = 150;
        $width = 150;
        $imaginary->resizeImage($file, $hight, $width);

        // Fonctionnel ???
        // $this->assertEquals($file->getHight(), $hight);
        // $this->assertEquals($file->getWidth(), $width);
    }

    public function testConnectionToImaginaryBeforeConvertFile(): void
    {
        $imaginary = new ImaginaryService;
        // $file = new DummyImaginaryFile;
        $file = $this->createMock(ImaginaryFileInterface::class);
        $extension = ".jpg";
        $imaginary->convertFile($file, $extension);
        $this->assertTrue($imaginary->spyConvert);
    }

    public function testConvertFileSuccessfull(): void
    {
        $imaginary = new ImaginaryService;
        // $file = new DummyImaginaryFile;
        $file = $this->createMock(ImaginaryFileInterface::class);
        $extension = ".jpg";
        $imaginary->convertFile($file, $extension);

        // Fonctionnel ???
        // $this->assertEquals($file->getExtension(), $extension);
    }

    public function testPingBeforeGitConnection(): void
    {
        $github = new GitService;
        $github->connect();
        $this->assertTrue($github->spyPing);
    }

    public function testGitServiceSuccessfullConnection(): void
    {
        $github = new GitService;
        $this->assertSame($github->connect(), 'Connected');
    }

    public function testDisconnectionFromGit(): void
    {
        $github = new GitService;
        $this->assertSame($github->disconnect(), 'Disconnected');
    }

    public function testConnectToGitBeforeAdd(): void
    {
        $github = new GitService;
        // $file = new DummyGitFile;
        $file = $this->createMock(GitFileInterface::class);
        $branchName = "myBranch";
        $github->add($file, $branchName);
        $this->assertTrue($github->spyAdd);
    }

    public function testGitAddBeforeCommit(): void
    {
        $github = new GitService;
        $branchName = "myBranch";
        $message = "commit message";
        $github->commit($branchName, $message);
        $this->assertTrue($github->spyCommit);
    }
    public function testGitCommitBeforePush(): void
    {
        $github = new GitService;
        // $file = new DummyGitFile;
        $file = $this->createMock(GitFileInterface::class);
        $branchName = "myBranch";
        $message = "commit message";
        $github->push($file, $branchName, $message);
        $this->assertTrue($github->spyPush);
    }

    public function testCRMPingBeforeConnection(): void
    {
        $hubspot = new CRMService;
        $hubspot->connect();
        $this->assertTrue($hubspot->spyConnect);
    }

    public function testCRMSuccessfullConnection(): void
    {
        $hubspot = new CRMService;
        $this->assertSame($hubspot->connect(), 'Connected');
    }

    public function testDisconnectionFromCRM(): void
    {
        $hubspot = new CRMService;
        $this->assertSame($hubspot->disconnect(), 'Disconnected');
    }

    public function testIfCRMClientExistBeforeCreation(): void
    {
        $hubspot = new CRMService;
        // $customer = new DummyCustomer();
        $customer = $this->createMock(CustomerInterface::class);
        $hubspot->createCustomer($customer);
        $this->assertTrue($hubspot->spyExist);
    }
}
