<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wallet;
use App\Models\Game;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{

    public function showWallet()
    {
        $wallet = Wallet::where('user_id', Auth::id())->first();
        
        return view('game_entry_page', compact('wallet'));
    }

    public function addToWallet(Request $request)
    {
        $wallet = new Wallet();
        $bonus_status = Auth::user()->bonus_status;
        if ($bonus_status && $bonus_status == 1) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bonus Already Collected!'
            ]);
        }
       
        $user = Auth::user();
        $user->bonus_status = 1; 
        $user->total_amount = 500;
        $user->save();
      
        $wallet->user_id = Auth::id();
        $wallet->wallet_amount += 500;
        $wallet->wallet_type = 'Bonus'; 
        $wallet->updated_by = Auth::id(); 
        $wallet->created_by = Auth::id(); 
        $wallet->save();
    
        return response()->json([
            'status' => 'success',
            'message' => 'Bonus Collected Successfully! ₹500 has been added to your wallet.' 
        ]);
    }
    
    public function addAmountToWallet(Request $request)
    {
        $request->validate([
            'amount' => 'required'
        ]);
    
        try {
            $wallet = new Wallet();
            if (!$wallet) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Wallet not found'
                ]);
            }
            $wallet->user_id = Auth::id();
            $wallet->wallet_amount = $request->amount; 
            $wallet->wallet_type = 'credit';  
            $wallet->updated_by = Auth::id(); 
            $wallet->created_by = Auth::id(); 

            $wallet->save();
    
            $user = Auth::user();
            $user->total_amount += $request->amount; 
            $user->save();
    
            return response()->json([
                'status' => 'success',
                'message' => '₹' . $user->total_amount . ' has been added to your wallet and user total.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
    
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again later.'
            ]);
        }
    }
    
    
    public function startGame()
    {
        return view('game_start');
    }
       
    public function storeEntranceFee(Request $request)
    {
        $lottery_key = rand(1, 3);
        $values_array = [
            '1' => 100,
            '2' => 200,
            '3' => 100
        ];
        $lottery_key = $values_array[$lottery_key];

        $winning_status = ($lottery_key == $request->selectedColor) ? 'Win' : 'Loss';
        $winning_value = ($winning_status == 'Win') ? $request->selectedColor : -100;

        $user = Auth::user();

        $user->total_amount -= 100;  

        if ($user->total_amount < 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Insufficient balance to play!'
            ]);
        }

        if ($winning_status == 'Win') {
            $user->total_amount += $winning_value;
        }
        
        $user->save();

        $game = new Game();
        $game->user_id = Auth::id();
        $game->entry_amount = 100; 
        $game->total_amount = $user->total_amount; 
        $game->select_value = $request->selectedColor;
        $game->winning_value = $winning_value;
        $game->game_status = $winning_status;
        $game->updated_by = Auth::id();
        $game->created_by = Auth::id();
        $game->save();

        $wallet = new Wallet();
        $wallet->user_id = Auth::id();
        $wallet->wallet_amount = $winning_value;  
        $wallet->game_status = 1;  
        $wallet->wallet_type = $winning_status; 
        $wallet->updated_by = Auth::id();
        $wallet->created_by = Auth::id();
        $wallet->save();

        $message = ($winning_status == 'Loss') ? 'Sorry, you lost ₹' . abs($winning_value) . ' Rs' : 'Congrats, you won ₹' . abs($winning_value) . ' Rs';

        return response()->json([
            'status' => 'success',
            'game_status' => $winning_status,
            'message' => $message,
            'new_balance' => $user->total_amount  
        ]);
    }

    // public function storeEntranceFee(Request $request)
    // {
    //     $lottery_key = rand(1, 3);
    //     $values_array = [
    //         '1' => 100,
    //         '2' => 200,
    //         '3' => 100
    //     ];
    //     $lottery_key = $values_array[$lottery_key];
    
    //     $winning_status = ($lottery_key == $request->selectedColor) ? 'Win' : 'Loss';
    //     $winning_value = ($winning_status == 'Win') ? $request->selectedColor : -100;
        
    //     $user = Auth::user();
    
    //     $user->total_amount -= 100;  
    //     if ($winning_status == 'Win') {
    //         $user->total_amount += $winning_value;
    //     }
    //     $user->save();  
    
    //     $game = new Game();
    //     $game->user_id = Auth::id();
    //     $game->entry_amount = 100; 
    //     $game->total_amount = $user->total_amount; 
    //     $game->select_value = $request->selectedColor;
    //     $game->winning_value = $winning_value;
    //     $game->game_status = $winning_status;
    //     $game->updated_by = Auth::id();
    //     $game->created_by = Auth::id();
    //     $game->save();
    
    //     $wallet = new Wallet();
    //     $wallet->user_id = Auth::id();
    //     $wallet->wallet_amount = $winning_value;  
    //     $wallet->game_status = 1;  
    //     $wallet->wallet_type = $winning_status; 
    //     $wallet->updated_by = Auth::id();
    //     $wallet->created_by = Auth::id();
    //     $wallet->save();
    
    //     $message = ($winning_status == 'Loss') ? 'Sorry You lost ₹' . abs($winning_value) . ' Rs' : 'Congrats You won ₹' . abs($winning_value) . ' Rs';
        
    //     return response()->json([
    //         'status' => 'success',
    //         'game_status' => $winning_status,
    //         'message' => $message,
    //         'new_balance' => $user->total_amount  
    //     ]);
    // }
    
}
