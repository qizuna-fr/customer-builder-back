<?php

namespace App\Tests;

use App\Exceptions\ConnectionGitException;
use App\Exceptions\ConnectionImaginaryException;
use App\Exceptions\DimensionErrorException;
use App\Exceptions\ExtensionErrorException;
use App\Interfaces\CSSManagementInterface;
use App\Interfaces\FormattingTextInterface;
use App\Interfaces\GitFileInterface;
use App\Interfaces\GitServiceInterface;
use App\Interfaces\ImaginaryFileInterface;
use App\Interfaces\ImaginaryServiceInterface;
use App\Services\CSSManagementService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Services\FormattingTextService;
use App\Services\GitService;
use App\Services\ImaginaryService;

class ServicesTest extends WebTestCase
{

    public function testFormatTextIsCalled(): void
    {
        $client = static::createClient();
        $client->request('GET', '/qizuna');
    }

    public function testFormatTextService(): void
    {
        $formatText = $this->createMock(FormattingTextInterface::class);
        $text = "Hello Word";
        $this->assertSame("hello-word", $formatText->deleteSpace($text));
    }

    public function testCSSManagementService(): void
    {
        $cssManagement = $this->createMock(CSSManagementInterface::class);
        $text = "title";

        $textFont = "Open Sans";
        $cssManagement->editFont($text, $textFont);

        $this->assertSame($cssManagement->spyFont, true);

        $textStyle = "capitalize";
        $cssManagement->editStyle($text, $textStyle);
        $this->assertSame($cssManagement->spyStyle, true);
        
        $textColor = "bold";
        $cssManagement->editColor($text, $textColor);
        $this->assertSame($cssManagement->spyColor, true);
    }

    public function testImaginaryServiceSuccsessfullConnection(): void
    {
        $imaginary = $this->createMock(ImaginaryServiceInterface::class);
        $this->assertSame($imaginary->connect(), 'Connected');
    }

    public function testImaginaryServiceFailureConnection(): void
    {
        $imaginary = $this->createMock(ImaginaryServiceInterface::class);
        $imaginary->connect();
        $this->expectException(ConnectionImaginaryException::class);
    }

    public function testDisconnectionFromImaginary(): void
    {
        $imaginary = $this->createMock(ImaginaryServiceInterface::class);
        $this->assertSame($imaginary->disconnect(), 'Disconnected');
    }

    public function testResizeImageFailure(): void
    {
        $imaginary = $this->createMock(ImaginaryServiceInterface::class);
        $file = $this->createMock(ImaginaryFileInterface::class);
        $hight = 50;
        $width = 50;
        $imaginary->resizeImage($file, $hight, $width);
        $this->assertInstanceOf(ImaginaryFileInterface::class, $file);
        $this->expectException(DimensionErrorException::class);
    }

    public function testResizeImageSuccessfull(): void
    {
        $imaginary = $this->createMock(ImaginaryServiceInterface::class);
        $file = $this->createMock(ImaginaryFileInterface::class);
        $hight = 150;
        $width = 150;
        $imaginary->resizeImage($file, $hight, $width);
        $this->assertInstanceOf(ImaginaryFileInterface::class, $file);
        $this->assertSame($imaginary->spyResize, true);
        $this->assertEquals($file->getHight(), $hight);
        $this->assertEquals($file->getWidth(), $width);
    }

    public function testConvertFileFailure(): void
    {
        $imaginary = $this->createMock(ImaginaryServiceInterface::class);
        $file = $this->createMock(ImaginaryFileInterface::class);
        $extension = ".txt";
        $imaginary->convertFile($file, $extension);
        $this->assertInstanceOf(ImaginaryFileInterface::class, $file);
        $this->expectException(ExtensionErrorException::class);
    }

    public function testConvertFileSuccessfull(): void
    {
        $imaginary = $this->createMock(ImaginaryServiceInterface::class);
        $file = $this->createMock(ImaginaryFileInterface::class);
        $extension = ".txt";
        $imaginary->convertFile($file, $extension);
        $this->assertInstanceOf(ImaginaryFileInterface::class, $file);
        $this->assertSame($imaginary->spyConvert, true);
        $this->assertEquals($file->getExtension(), $extension);
    }

    public function testGitServiceSuccessfullConnection(): void
    {
        $github = $this->createMock(GitServiceInterface::class);
        $this->assertSame($github->connect(), 'Connected');
    }

    public function testGitServiceFailureConnection(): void
    {
        $github = $this->createMock(GitServiceInterface::class);
        $github->connect();
        $this->expectException(ConnectionGitException::class);
    }

    public function testDisconnectionFromGit(): void
    {
        $github = $this->createMock(GitServiceInterface::class);
        $this->assertSame($github->disconnect(), 'Disconnected');
    }

    public function testPushFileToGit(): void
    {
        $github = $this->createMock(GitServiceInterface::class);
        $file = $this->createMock(GitFileInterface::class);
        $branchName = "myBranch";
        $message = "commit message";
        $github->push($file, $branchName, $message);
        $this->assertInstanceOf(GitFileInterface::class, $file);
        $this->assertTrue($github->spyPush);
    }

    

}
