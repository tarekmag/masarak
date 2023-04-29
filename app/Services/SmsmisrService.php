<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class SmsmisrService 
{
    protected $endpoint;
    protected $username;
    protected $password;
    protected $sender;

    public function __construct()
    {
        $this->endpoint = env('SMSMISR_ENDPOINT');
        $this->username = env('SMSMISR_USERNAME');
        $this->password = env('SMSMISR_PASSWORD');
        $this->sender = env('SMSMISR_SENDER');
    }

    /**
     * @param string $message
     * @param array $toNumbers
     * @param string|null $sender
     * @param int $language 1 is English, 2 is Arabic, 3 is For Unicode
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function send(string $message, array $toNumbers, $language = 2, $sender = null)
    {
        $data = [
            'username' => $this->username,
            'password' => $this->password,
            'language' => $language,
            'sender' => $sender ?? $this->sender,
            'message' => ($language == 3) ? $this->messageToGsmFormat($message) : $message,
            'mobile' => implode(',', $this->handlePhoneCode($toNumbers)),
            'DelayUntil' => null,
        ];

        try {
            $response = Http::withHeaders([])->post($this->endpoint.'/v2', $data);
            if ($response->ok()) 
            {
                $result = $response->object();
                return ['status' => ($result->code == 1901) ? true : false, 'message' => $this->getResponseCodes($result->code)];
            }
            return ['status' => false, 'message' => 'Not Success'];
        } catch (\Throwable $th) {
            info($th->getMessage());
            return ['status' => false, 'message' => $th->getMessage()];
        }
    }

    /**
     * @param string $message
     * @param array $toNumbers
     * @param string|null $sender
     * @param int $language 1 is English, 2 is Arabic, 3 is For Unicode
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendVerify(string $message, array $toNumbers, $language = 2, $sender = null)
    {
        $data = [
            'username' => $this->username,
            'password' => $this->password,
            'language' => $language,
            'sender' => $sender ?? $this->sender,
            'message' => ($language == 3) ? $this->messageToGsmFormat($message) : $message,
            'mobile' => implode(',', $this->handlePhoneCode($toNumbers)),
            'DelayUntil' => null,
        ];

        try {
            $response = Http::withHeaders([])->post($this->endpoint.'/verify', $data);
            if ($response->ok()) 
            {
                $result = $response->object();
                return ['status' => ($result->code == 1901) ? true : false, 'message' => $this->getResponseCodes($result->code)];
            }
            return ['status' => false, 'message' => 'Not Success'];
        } catch (\Throwable $th) {
            info($th->getMessage());
            return ['status' => false, 'message' => $th->getMessage()];
        }
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getBalance()
    {
        $data = [
            'username' => $this->username,
            'password' => $this->password,
            'request' => 'status',
            'SMSID' => 4945703,
        ];

        try {
            $response = Http::withHeaders([])->post($this->endpoint.'/Request', $data);
            if ($response->ok()) 
            {
                $result = $response->object();
                return ['status' => ($result->code == 1901) ? true : false, 'message' => $this->getResponseCodes($result->code)];
            }
            return ['status' => false, 'message' => 'Not Success'];
        } catch (\Throwable $th) {
            info($th->getMessage());
            return ['status' => false, 'message' => $th->getMessage()];
        }
    }

    private function getResponseCodes($responseCode)
    {
        switch ($responseCode) {
            case 1901:
                return "Success, Message Submitted Successfully";
                break;

            case 1902:
                return "Invalid URL , This means that one of the parameters was not provided";
                break;

            case 1200:
                return "You sent a lot of requests at the same time , please make a delay at least 1 sec";
                break;

            case 1903:
                return "Invalid value in username or password field";
                break;

            case 1904:
                return "Invalid value in 'sender' field";
                break;

            case 1905:
                return "Invalid value in 'mobile' field";
                break;

            case 1906:
                return "Insufficient Credit.";
                break;

            case 1907:
                return "Server under updating";
                break;

            case 1908:
                return "Invalid Date & Time format in “DelayUntil=” parameter";
                break;

            case 1909:
                return "Error In Message";
                break;

            case 8001:
                return "Mobile IS Null";
                break;

            case 8002:
                return "Message IS Null";
                break;

            case 8003:
                return "Language IS Null";
                break;

            case 8004:
                return "Sender IS Null";
                break;

            case 8005:
                return "Username IS Null";
                break;

            case 8006:
                return "Password IS Null";
                break;

            case 6000:
                return "Success, Request Submitted Successfully";
                break;
                
            case 'Error':
                return "Invalid URL , This means that one of the parameters was not provided or wrong information";
                break;

            default:
                Log::info("UNKNOWN CODE : $responseCode");
                return "Unknown Code : $responseCode";
                break;
        }
    }

    protected function messageToGsmFormat(string $message, string $replace = '?'): string
    {
        $dict = [
            '@' => "\x00",
            '£' => "\x01",
            '$' => "\x02",
            '¥' => "\x03",
            'è' => "\x04",
            'é' => "\x05",
            'ù' => "\x06",
            'ì' => "\x07",
            'ò' => "\x08",
            'Ç' => "\x09",
            'Ø' => "\x0B",
            'ø' => "\x0C",
            'Å' => "\x0E",
            'å' => "\x0F",
            'Δ' => "\x10",
            '_' => "\x11",
            'Φ' => "\x12",
            'Γ' => "\x13",
            'Λ' => "\x14",
            'Ω' => "\x15",
            'Π' => "\x16",
            'Ψ' => "\x17",
            'Σ' => "\x18",
            'Θ' => "\x19",
            'Ξ' => "\x1A",
            'Æ' => "\x1C",
            'æ' => "\x1D",
            'ß' => "\x1E",
            'É' => "\x1F",
            'Ä' => "\x5B",
            'Ö' => "\x5C",
            'Ñ' => "\x5D",
            'Ü' => "\x5E",
            '§' => "\x5F",
            '¿' => "\x60",
            'ä' => "\x7B",
            'ö' => "\x7C",
            'ñ' => "\x7D",
            'ü' => "\x7E",
            'à' => "\x7F",
            '^' => "\x1B\x14",
            '{' => "\x1B\x28",
            '}' => "\x1B\x29",
            '\\' => "\x1B\x2F",
            '[' => "\x1B\x3C",
            '~' => "\x1B\x3D",
            ']' => "\x1B\x3E",
            '|' => "\x1B\x40",
            '€' => "\x1B\x65"
        ];

        $converted = strtr($message, $dict);

        return preg_replace('/([\\xC0-\\xDF].)|([\\xE0-\\xEF]..)|([\\xF0-\\xFF]...)/m', $replace, $converted);
    }

    /**
     * Handle Phones country code
     */
    public function handlePhoneCode($phones)
    {
        $code = '02';
        $result = collect();
        foreach($phones as $phone)
        {
            $phone = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $phone);
            $strlen = strlen($phone);
            if($strlen == 13)
            {
                $countryCodeArray13 = [$code . '0', $code . '1'];
                $countryCode13 = substr($phone, 0, 3);
                if(in_array($countryCode13, $countryCodeArray13))
                {
                    $countryCode13 = substr($phone, 2, 11);
                    $phoneFormat = $code . '' . $countryCode13;
                    $result->push($phoneFormat);
                }
            }
            elseif($strlen == 11)
            {
                $countryCodeArray11 = ['0', '1'];
                $countryCode11 = substr($phone, 0, 2);
                if(in_array($countryCode11, $countryCodeArray11)){
                    $phoneFormat = $code . '' . $phone;
                    $result->push($phoneFormat);
                }
            }
        }

        return $result->toArray();
    }
}