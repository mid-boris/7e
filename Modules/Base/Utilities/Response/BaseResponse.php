<?php

namespace Modules\Base\Utilities\Response;

use Exception;
use Illuminate\Validation\ValidationException;
use Modules\Error\Constants\ErrorCode;
use ReflectionException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BaseResponse
{
    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function response($data)
    {
        return response()
            ->json($data)
            ->withHeaders([
                'code' => 0,
            ]);
    }

    /**
     * @param Exception $e
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public static function exception(Exception $e)
    {
        if ($e instanceof ReflectionException) {
            /* 某些reflection發生時會被trigger很多次 */
            header('Content-Type: application/json; charset=utf-8');
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode([
                'message' => $e->getMessage()
            ]);
            exit;
        }
        $code = $e->getCode();
        $statusCode = self::isHttpException($e) ? $e->getStatusCode() : 500;
        $errorMessage = self::isValidationException($e) ? $e->errors() : $e->getMessage();
        self::notApi($code, $statusCode, $errorMessage);
        return response()
            ->json([
                'message' => $errorMessage,
            ])
            ->setStatusCode($statusCode)
            ->withHeaders([
                'code' => $code,
            ]);
    }

    private static function notApi($code, $statusCode, $message)
    {
        if (!\Request::is('api/*')) {
            $message = addslashes($message);
            if ($code == ErrorCode::ENTRUST_USER_LOGIN_ERROR) {
                echo "<script>alert('Error({$code}): {$message}');</script>";
                $url = \Request::root();
                echo "<script>location.href = '{$url}';</script>";
                exit;
            }
            $code = $code == 0 ? $statusCode : $code;
            $hasSql = strpos($message, 'SQL');
            if ($hasSql !== false) {
                $message = 'SQL Error.';
            }
            $str = 'Error({' . $code . '}): ' . $message;
            echo '<script>alert("' . $str .'");history.go(-1);</script>';
            exit;
        }
    }

    /**
     * Determine if the given exception is an HTTP exception.
     *
     * @param  Exception  $e
     * @return bool
     */
    protected static function isHttpException(Exception $e)
    {
        return $e instanceof HttpException;
    }

    /**
     * @param Exception $e
     * @return bool
     */
    protected static function isValidationException(Exception $e)
    {
        return $e instanceof ValidationException;
    }
}
