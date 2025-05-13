<?php


namespace App\Http\Controllers;

use App\Http\Requests\User\UpdatePasswordRequest;
use App\Http\Requests\User\UpdateProfileRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Get the authenticated user's profile.
     */
    public function show(Request $request): JsonResponse
    {
        return $this->successResponse($request->user(), 'Profile retrieved successfully.');
    }

    /**
     * Update the authenticated user's profile and avatar.
     */
    public function update(UpdateProfileRequest $request): JsonResponse
    {
        if (app()->environment('local', 'staging')) {
            \Log::info('Request Data:', $request->only(['name', 'email']));
        }
// Log the request data to check if the fields are there



        $user = $request->user();
        $user->fill($request->only(['name', 'email']));

        if ($request->hasFile('avatar')) {
            \Log::info("Avatar file is uploaded");
            $user->avatar_url = $this->handleAvatarUpload($request);
        }

        $user->save();
        return $this->successResponse($user, 'Profile updated successfully.');
    }


    /**
     * Update the authenticated user's password.
     */
    public function updatePassword(UpdatePasswordRequest $request): JsonResponse
    {
        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return $this->errorResponse('Current password is incorrect.', 403);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return $this->successResponse(null, 'Password updated successfully.');
    }

    /**
     * Delete the authenticated user account and revoke all tokens.
     */
    public function destroy(Request $request): JsonResponse
    {
        $user = $request->user();
        $user->tokens()->delete(); // Revoke tokens

        if ($user->avatar_url) {
            $this->deleteAvatar($user->avatar_url);
        }

        $user->delete();

        return $this->successResponse(null, 'User account deleted successfully.');
    }

    /**
     * Handle avatar file upload and return the public URL.
     */
    protected function handleAvatarUpload(Request $request): string
    {
        $avatar = $request->file('avatar');

        $path = $avatar->storeAs(
            'avatars/' . $request->user()->id,
            uniqid('avatar_', true) . '.' . $avatar->getClientOriginalExtension(),
            'public'
        );

        return Storage::disk('public')->url($path);
    }

    /**
     * Delete avatar file from storage.
     */
    protected function deleteAvatar(string $url): void
    {
        $path = str_replace(Storage::disk('public')->url('/'), '', $url);
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * Uniform success response format.
     */
    protected function successResponse($data, string $message = ''): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ]);
    }

    /**
     * Uniform error response format.
     */
    protected function errorResponse(string $message, int $statusCode = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $statusCode);
    }
}
