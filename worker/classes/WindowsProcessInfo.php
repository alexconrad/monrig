<?php

class WindowsProcessInfo
{
    public $Node;
    public $Caption;
    public $CommandLine;
    public $CreationClassName;
    public $CreationDate;
    public $CSCreationClassName;
    public $CSName;
    public $Description;
    public $ExecutablePath;
    public $ExecutionState;
    public $Handle;
    public $HandleCount;
    public $InstallDate;
    public $KernelModeTime;
    public $MaximumWorkingSetSize;
    public $MinimumWorkingSetSize;
    public $Name;
    public $OSCreationClassName;
    public $OSName;
    public $OtherOperationCount;
    public $OtherTransferCount;
    public $PageFaults;
    public $PageFileUsage;
    public $ParentProcessId;
    public $PeakPageFileUsage;
    public $PeakVirtualSize;
    public $PeakWorkingSetSize;
    public $Priority;
    public $PrivatePageCount;
    public $ProcessId;
    public $QuotaNonPagedPoolUsage;
    public $QuotaPagedPoolUsage;
    public $QuotaPeakNonPagedPoolUsage;
    public $QuotaPeakPagedPoolUsage;
    public $ReadOperationCount;
    public $ReadTransferCount;
    public $SessionId;
    public $Status;
    public $TerminationDate;
    public $ThreadCount;
    public $UserModeTime;
    public $VirtualSize;
    public $WindowsVersion;
    public $WorkingSetSize;
    public $WriteOperationCount;
    public $WriteTransferCount;

    public function __construct($array)
    {
        foreach ($array as $key=>$value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}