<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // 9079
    public function navigate_to_help_topics_9079()
    {
        return view('help.9079.helpTopics');
    }

    public function navigate_to_error_help_topics_9079()
    {
        return view('help.9079.errorHelpTopics');
    }

    public function navigate_to_software_working_procedure_9079()
    {
        return view('help.9079.softwareWorkingProcedure');
    }

    public function navigate_to_about_software_9079()
    {
        return view('help.9079.aboutSoftware');
    }

    // 12225
    public function navigate_to_help_topics_12225()
    {
        return view('help.12225.helpTopics');
    }

    public function navigate_to_error_help_topics_12225()
    {
        return view('help.12225.errorHelpTopics');
    }

    public function navigate_to_software_working_procedure_12225()
    {
        return view('help.12225.softwareWorkingProcedure');
    }

    public function navigate_to_about_software_12225()
    {
        return view('help.12225.aboutSoftware');
    }

    // 8472
    public function navigate_to_help_topics_8472()
    {
        return view('help.8472.helpTopics');
    }

    public function navigate_to_error_help_topics_8472()
    {
        return view('help.8472.errorHelpTopics');
    }

    public function navigate_to_software_working_procedure_8472()
    {
        return view('help.8472.softwareWorkingProcedure');
    }

    public function navigate_to_about_software_8472()
    {
        return view('help.8472.aboutSoftware');
    }

    // 8034
    public function navigate_to_help_topics_8034()
    {
        return view('help.8034.helpTopics');
    }

    public function navigate_to_error_help_topics_8034()
    {
        return view('help.8034.errorHelpTopics');
    }

    public function navigate_to_software_working_procedure_8034()
    {
        return view('help.8034.softwareWorkingProcedure');
    }

    public function navigate_to_about_software_8034()
    {
        return view('help.8034.aboutSoftware');
    }

    // 6595
    public function navigate_to_help_topics_6595()
    {
        return view('help.6595.helpTopics');
    }

    public function navigate_to_error_help_topics_6595()
    {
        return view('help.6595.errorHelpTopics');
    }

    // public function navigate_to_software_working_procedure_6595()
    // {
    //     return view('help.6595.softwareWorkingProcedure');
    // }

    public function navigate_to_about_software_6595()
    {
        return view('help.6595.aboutSoftware');
    }

    // 9283
    public function navigate_to_help_topics_9283()
    {
        return view('help.9283.helpTopics');
    }

    public function navigate_to_error_help_topics_9283()
    {
        return view('help.9283.errorHelpTopics');
    }

    public function navigate_to_software_working_procedure_9283()
    {
        return view('help.9283.softwareWorkingProcedure');
    }

    public function navigate_to_about_software_9283()
    {
        return view('help.9283.aboutSoftware');
    }

    // 14220
    public function navigate_to_help_topics_14220()
    {
        return view('help.14220.helpTopics');
    }

    public function navigate_to_error_help_topics_14220()
    {
        return view('help.14220.errorHelpTopics');
    }

    public function navigate_to_software_working_procedure_14220()
    {
        return view('help.14220.softwareWorkingProcedure');
    }

    public function navigate_to_about_software_14220()
    {
        return view('help.14220.aboutSoftware');
    }
}