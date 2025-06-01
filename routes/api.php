<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialReportController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizReportController;
use App\Http\Controllers\ChallengeController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'authenticate']);
// Route::get('/user', [UserController::class, 'getUser']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::post('/profile', [ProfileController::class, 'update']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/email/verify', [RegisterController::class, 'verifyEmail'])->name('verification.notice');
    Route::post('/email/verify', [RegisterController::class, 'resendEmailVerification'])->name('verification.send');
});

Route::get('/verify-email/{id}/{hash}', function (EmailVerificationRequest $request) {
    // Fulfill the email verification
    $request->fulfill();

    // Return a response (you can customize this response)
    return response()->json(['message' => 'Email verified successfully.'], 200);
})->name('verification.verify')->middleware(['auth:sanctum', 'signed']);

Route::post('/reset-password', [ResetPasswordController::class, 'sendResetLink']);
Route::post('/reset-password/confirm', [ResetPasswordController::class, 'resetPassword']);

// chatbot
Route::post('/chat', [ChatController::class, 'kirimChat']);

Route::middleware('auth:sanctum')->get('/user-materials', [MaterialController::class, 'userCompletedMaterials']);
Route::middleware('auth:sanctum')->get('/user-challenge', [ChallengeController::class, 'userCompletedChallenges']);

Route::middleware('auth:sanctum')->post('/progress', [MaterialReportController::class, 'trackProgress']);
Route::middleware('auth:sanctum')->get('/overall-progress', [MaterialReportController::class, 'overallProgress']);
Route::middleware('auth:sanctum')->get('/completed-materials', [MaterialReportController::class, 'getCompletedMaterials']);
Route::middleware('auth:sanctum')->get('/completed-materials-details', [MaterialReportController::class, 'getCompletedMaterials']);



// kuis
Route::get('/quizzes', [QuizController::class, 'index']);
Route::get('/quizzes', [QuizController::class, 'index'])
    ->where('pollution_type_id', '[0-9]+')
    ->where('subbab', '[0-9]+');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/quiz-reports', [QuizReportController::class, 'index']);
    Route::post('/quiz-reports', [QuizReportController::class, 'store']);
});

Route::get('/materials/{id}', [MaterialController::class, 'show']);

// challenge
Route::get('/challenges-fetch', [ChallengeController::class, 'showchallenge']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/challenges/claim', [ChallengeController::class, 'claimChallenge']);
    Route::get('/user/claimed-challenge', [ChallengeController::class, 'showClaimed']);
    Route::post('/user/submit-proof', [ChallengeController::class, 'submitProof']);
    Route::get('/challenge-progress', [ChallengeController::class, 'overallProgress']);
    Route::get('/challenge/countdown', [ChallengeController::class, 'getCountdown']);
    Route::post('/user/deactivate-challenge-report', [ChallengeController::class, 'deactivate']);
    Route::get('/check-active-challenge', [ChallengeController::class, 'checkActiveChallenge']);
    Route::post('/send-reminder-email', [ChallengeController::class, 'sendReminderEmail']);
    Route::get('/check-reminder-status', [ChallengeController::class, 'checkReminderStatus']);
    Route::post('/user/fail-challenge', [ChallengeController::class, 'failChallenge']);
});

Route::get('/hello', fn() => 'Hello from backend');

