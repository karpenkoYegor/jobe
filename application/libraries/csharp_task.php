<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* ==============================================================
 *
 * C++
 *
 * ==============================================================
 *
 * @copyright  2014 Richard Lobb, University of Canterbury
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('application/libraries/LanguageTask.php');

class Csharp_Task extends Task {

    public function __construct($filename, $input, $params) {
        parent::__construct($filename, $input, $params);
        
    }

    public static function getVersionCommand() {
        return array('dotnet --version', '/(\d{1,3}\.\d{1,3}\.\d{1,3})/');
    }

    public function compile() {
        $src = basename($this->sourceFileName);
        
        $this->executableFileName = $execFileName = "$src.exe";
        $compileargs = $this->getParam('compileargs');
        $linkargs = $this->getParam('linkargs');
        $cmd = "DOTNET_GCHeapHardLimit=1C0000000 dotnet new console; dotnet run";
        list($output, $this->cmpinfo) = $this->run_in_sandbox($cmd);
    }


    // A default name for C# programs
    public function defaultFileName($sourcecode) {
        return 'Program.cs';
    }


    // The executable is the output from the compilation
    public function getExecutablePath() {
        return "./" . $this->executableFileName;
    }


    public function getTargetFile() {
        return '';
    }
};
