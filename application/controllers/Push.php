<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Push extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_push');
    }

    public function send()
    {
        $publicKey = "BC95eIvC37YDwxARmrSkiyIC6nU1x8hFbqIUBBtW4-rC2SJhAfllaulfW0vBDldrNGJBxXZzMgKOIslmsmCv8rk";
        $privateKey = "3HVMIFWdLTV9beC_MIk1hAB0hRCAK3niNeVA1KG-QWY";

        require FCPATH . 'vendor/autoload.php';

        $query = $this->db->get('user_subscribed')->row();
        $subscription = Minishlink\WebPush\Subscription::create([
            'endpoint' => $query->endPoint,
            'authToken' => $query->authToken,
            'publicKey' => $query->publicKey,
            'contentEncoding' => $query->contentEncoding
        ]);

        $auth = array(
            'VAPID' => array(
                'subject' => 'https://github.com/Minishlink/web-push-php-example/',
                'publicKey' => $publicKey,
                'privateKey' => $privateKey
            ),
        );

        $webPush = new Minishlink\WebPush\WebPush($auth);

        $msg = [
            "text" => "Cek push notif PWA, JSON",
            "url" => "https://unma.ac.id",
            "tag" => "Notif"
        ];

        $report = $webPush->sendOneNotification(
            $subscription,
            json_encode($msg)
        );

        // handle eventual errors here, and remove the subscription from your server if it is expired
        $endpoint = $report->getRequest()->getUri()->__toString();

        if ($report->isSuccess()) {
            echo "[v] Message sent successfully for subscription {$endpoint}.";
        } else {
            echo "[x] Message failed to sent for subscription {$endpoint}: {$report->getReason()}";
        }
    }

    public function send_multiple()
    {
        $publicKey = "BC95eIvC37YDwxARmrSkiyIC6nU1x8hFbqIUBBtW4-rC2SJhAfllaulfW0vBDldrNGJBxXZzMgKOIslmsmCv8rk";
        $privateKey = "3HVMIFWdLTV9beC_MIk1hAB0hRCAK3niNeVA1KG-QWY";

        require FCPATH . 'vendor/autoload.php';

        // here I'll get the subscription endpoint in the POST parameters
        // but in reality, you'll get this information in your database
        // because you already stored it (cf. push_subscription.php)
        $query = $this->db->get('user_subscribed')->result();
        $data_prep = [];

        foreach ($query as $value) {
            array_push($data_prep, [
                'subscription' => Minishlink\WebPush\Subscription::create([
                    'endpoint' => $value->endPoint,
                    'authToken' => $value->authToken,
                    'publicKey' => $value->publicKey,
                    'contentEncoding' => $value->contentEncoding
                ]),
                'msg' => [
                    "text" => "Cek push notif PWA, Encoding : " . $value->contentEncoding,
                    "url" => "https://unma.ac.id",
                    "tag" => "Notif"
                ]
            ]);
        }

        $auth = array(
            'VAPID' => array(
                'subject' => 'https://github.com/Minishlink/web-push-php-example/',
                'publicKey' => $publicKey,
                'privateKey' => $privateKey
            ),
        );

        $webPush = new Minishlink\WebPush\WebPush($auth);

        // send multiple notifications with payload
        foreach ($data_prep as $notification) {
            $webPush->queueNotification(
                $notification['subscription'],
                json_encode($notification['msg'])
            );
        }

        foreach ($webPush->flush() as $report) {
            $endpoint = $report->getRequest()->getUri()->__toString();

            if ($report->isSuccess()) {
                echo "[v] Message sent successfully for subscription {$endpoint}.";
            } else {
                echo "[x] Message failed to sent for subscription {$endpoint}: {$report->getReason()}";
            }
        }
    }

    public function save()
    {
        $ip_address = $this->input->ip_address();
        $os = $this->agent->platform();
        $platform = $this->agent->platform();
        $browser = $this->agent->browser();
        $endPoint = $this->input->post('endPoint');
        $authToken = $this->input->post('authToken');
        $publicKey = $this->input->post('publicKey');
        $contentEncoding = $this->input->post('contentEncoding');

        $data_insert = [
            'ip_address' => $ip_address,
            'os' => $os,
            'platform' => $platform,
            'browser' => $browser,
            'endPoint' => $endPoint,
            'authToken' => $authToken,
            'publicKey' => $publicKey,
            'contentEncoding' => $contentEncoding
        ];

        $data_update = [
            'os' => $os,
            'platform' => $platform,
            'browser' => $browser,
            'endPoint' => $endPoint,
            'authToken' => $authToken,
            'publicKey' => $publicKey,
            'contentEncoding' => $contentEncoding
        ];

        $query = $this->Model_push->get_data('user_subscribed', [
            'ip_address' => $ip_address,
            'os' => $os,
            'platform' => $platform
        ]);
        if ($query->num_rows() > 0) {
            $query = $this->Model_push->save('user_subscribed', $data_update, [
                'ip_address' => $ip_address,
                'os' => $os,
                'platform' => $platform
            ]);
        } else {
            $query = $this->Model_push->save('user_subscribed', $data_insert);
        }

        if ($query) {
            $json = [
                'status' => true,
                'pesan' => "Tersimpan"
            ];
        } else {
            $json = [
                'status' => false,
                'pesan' => "Gagal Tersimpan"
            ];
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
}

/* End of file Push.php */
