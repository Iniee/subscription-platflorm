<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
  /**
   * Handles successful API response
   */
  public function successResponse(
    string $message,
    $data = null,
    int $code = JsonResponse::HTTP_OK
  ): JsonResponse {
    $successResponseData = $this->responseData(
      $code,
      true,
      $message
    );

    if ($data) {
      $successResponseData['data'] = $data;
    }

    return response()->json($successResponseData, $code);
  }

  /**
   * Handles failed API response
   */
  public function failedResponse(
    string $message,
    int $code = JsonResponse::HTTP_BAD_REQUEST
  ): JsonResponse {
    return response()->json($this->responseData(
      $code,
      false,
      $message
    ), $code);
  }

  /**
   * Handles validation API response
   */
  public function validationResponse(
    array $errors
  ): JsonResponse {
    $code = JsonResponse::HTTP_UNPROCESSABLE_ENTITY;
    $validationResponseData = $this->responseData(
      $code,
      false,
      'The given data was invalid.'
    );
    $validationResponseData['errors'] = $errors;

    return response()->json($validationResponseData, $code);
  }

  /**
   * Default response data instance
   */
  private function responseData(
    int $code,
    bool $status,
    string $message
  ): array {
    return [
      'code' => $code,
      'status' => $status,
      'summary' => $this->formattedResponseSummary($code),
      'message' => $message,
    ];
  }

  /**
   * Get formatted response summary
   */
  private function formattedResponseSummary(int $code): string
  {
    /** @var array<int, string> */
    $jsonResponseStatusTexts = JsonResponse::$statusTexts;
    if (array_key_exists($code, $jsonResponseStatusTexts)) {
      switch ($code) {
        case 200:
          $codeStatusText = 'Success';
          break;

        case 422:
          $codeStatusText = 'Validation Failed';
          break;

        default:
          $codeStatusText = $jsonResponseStatusTexts[$code];
          break;
      }

      return "{$code}, {$codeStatusText}";
    }

    return "{$code}, Something Went Wrong";
  }
}