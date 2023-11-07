<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Requests\PreferencesRequest;
use App\Models\Quiz;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    
    public function preferences(Quiz $quiz)
    {
        $flagged_num = $quiz->where([['user_id', Auth::user()->id], ['question_flag', 1]])->count();
        return view('profile.preferences')->with(['flagged_num' => $flagged_num]);
    }
    
    public function update_preferences(PreferencesRequest $request)
    {
        $input = $request['user'];
        Auth::user()->fill($input)->save();
        return redirect('/profile/preferences');
    }
    
    //ログインユーザーのすべてのクイズのquestion_flagを1から0にリセットする
    public function reset_all_flags(){
        $user_id = Auth::user()->id;
        DB::table('quizzes')->where([
                ['user_id', $user_id],
                ['question_flag', 1],
            ])->update(['question_flag' => 0]);
        return redirect('/profile/preferences');
    }
}
