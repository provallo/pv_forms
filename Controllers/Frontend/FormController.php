<?php

namespace ProVallo\Controllers\Frontend;

use ProVallo\Components\Controller;
use ProVallo\Core;
use ProVallo\Plugins\Forms\Models\Form\Form;
use ProVallo\Plugins\Forms\Models\Form\Submission;

class FormController extends Controller
{
    
    public function submitAction ()
    {
        $id       = (int) self::request()->getParam('id');
        $formData = self::request()->getParam('data');
        $form     = Form::repository()->find($id);
        
        if ($form instanceof Form)
        {
            //
            $gRecaptchaResponse = self::request()->getParam('g-recaptcha-response');
            $secret             = \ProVallo\Plugins\Forms\Bootstrap::getConfig()['recaptcha.secret_key'];
            $remoteIp           = self::request()->getServerParam('REMOTE_ADDR');
            $domain             = Core::di()->get('frontend.domain')->getCurrentDomain()->host;
            
            $recaptcha = new \ReCaptcha\ReCaptcha($secret);
            $resp      = $recaptcha->setExpectedHostname($domain)
                ->setExpectedAction('form_' . $id)
                ->setScoreThreshold(0.5)
                ->verify($gRecaptchaResponse, $remoteIp);
            
            if (!$resp->isSuccess())
            {
                $errors = $resp->getErrorCodes();
                
                return self::json()->failure([
                    'errors' => $errors
                ]);
            }
            
            $data   = json_decode($form->data, true);
            $result = $this->getResult($data, $formData);
            
            $template = $form->submissionTemplate;
            $template = strtr($template, $result);
            
            $submission          = Submission::create();
            $submission->formID  = $form->id;
            $submission->data    = $template;
            $submission->created = date('Y-m-d H:i:s');
            $submission->save();
            
            return self::json()->success();
        }
        
        return self::json()->failure([
            'message' => 'Form by id not found'
        ]);
    }
    
    protected function getResult ($data, $formData)
    {
        $result = [];
        
        foreach ($data['items'] as $item)
        {
            $value = null;
            
            switch ((int) $item['itemRef'])
            {
                case 1:
                case 2:
                case 6:
                    $value = null;
                break;
                case 5:
                    $value = isset($formData[$item['id']]) ? 'Yes' : 'No';
                break;
                default:
                    $value = $formData[$item['id']];
            }
            
            $result['$' . $item['id']] = $value;
        }
        
        return $result;
    }
    
}