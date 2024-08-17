<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use App\Models\Resort;
use App\Models\Reserve;
use App\Models\ResortRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    public function loginpage()
    {
        return view('login');
    }

    // Not Login Page
    public function aboutpage()
    {
        return view('about');
    }
    public function contactpage()
    {
        return view('contact');
    }
    public function indexpage()
    {
        return view('index');
    }
    public function resortspage()
    {
        return view('resorts');
    }
    // ===============

    // Login Client Page
        public function uabout()
        {
            $token = request()->cookie('bearer_token');
            return view('uabout', ['apiToken' => $token]);
        }
        public function ucontact()
        {
            $token = request()->cookie('bearer_token');
            return view('ucontact', ['apiToken' => $token]);
        }
        public function uindex()
        {
            $token = request()->cookie('bearer_token');
            return view('uindex', ['apiToken' => $token]);
        }
        public function uprofile()
        {
            $token = request()->cookie('bearer_token');
            return view('uprofile', ['apiToken' => $token]);
        }
        public function uresorts()
        {
            $token = request()->cookie('bearer_token');
            return view('uresorts', ['apiToken' => $token]);
        }
    // ==================

    // Incharge Page
    public function inchargeIndex()
    {
        $token = request()->cookie('bearer_token');
        return view('in-charge.index', ['apiToken' => $token]);
    }
    public function inchargeProfile()
    {
        $token = request()->cookie('bearer_token');
        return view('in-charge.profile', ['apiToken' => $token]);
    }
    public function inchargeReserved()
    {
        $token = request()->cookie('bearer_token');
        return view('in-charge.reserved', ['apiToken' => $token]);
    }
    public function inchargeResorts()
    {
        $token = request()->cookie('bearer_token');
        return view('in-charge.resorts', ['apiToken' => $token]);
    }
    public function inchargeRooms()
    {
        $token = request()->cookie('bearer_token');
        return view('in-charge.rooms', ['apiToken' => $token]);
    }
    // =================

    // Admin Page
    public function adminIndex()
    {
        $token = request()->cookie('bearer_token');
        return view('admin.index', ['apiToken' => $token]);
    }
    public function adminProfile()
    {
        $token = request()->cookie('bearer_token');
        return view('admin.profile', ['apiToken' => $token]);
    }
    public function adminReserved()
    {
        $token = request()->cookie('bearer_token');
        return view('admin.reserved', ['apiToken' => $token]);
    }
    public function adminResorts()
    {
        $token = request()->cookie('bearer_token');
        return view('admin.resorts', ['apiToken' => $token]);
    }
    public function adminRooms()
    {
        $token = request()->cookie('bearer_token');
        return view('admin.rooms', ['apiToken' => $token]);
    }
    // =================

    // API Method
    public function addreserve(Request $request)
    {
        $resort_id = $request->input('resort_id');
        $room_id = $request->input('room_id');
        $account_id = $request->has('account_id') ? $request->input('account_id') : request()->cookie('account_id');
        $date_reserved = $request->input('date_reserved');
        $response = [];

        try {
            // Check if the room is available
            $isRoomAvailable = ResortRoom::where('room_id', $room_id)
                ->where('resort_id', $resort_id)
                ->where('status', 'not_booked')
                ->exists();

            if (!$isRoomAvailable) {
                $response['failed'] = "Selected room is not available for reservation.";
                return response()->json($response);
            }

            // Create a reservation
            $reserve = new Reserve([
                'resort_id' => $resort_id,
                'room_id' => $room_id,
                'account_id' => $account_id,
                'date_reserved' => $date_reserved,
            ]);

            $reserve->save();

            // Update the room status to 'booked'
            ResortRoom::where('room_id', $room_id)
                ->where('resort_id', $resort_id)
                ->update(['status' => 'booked']);

            $response['title'] = 'Action successful!';
            $response['text'] = 'Reserve successful';
            $response['icon'] = 'success';
        } catch (\Exception $e) {
            $response['failed'] = "Failed to reserve. Error: " . $e->getMessage();
        }

        return response()->json($response);
    }
    public function addResort(Request $request)
    {
        $response = [];

        DB::beginTransaction();

        try {
            $resort_name = $request->input('resort_name');
            $location = $request->input('location');
            $resort_description = $request->input('resort_description');
            $price = $request->input('price');
            $rooms = $request->input('room');

            $resort = new Resort();
            $resort->resort_name = $resort_name;
            $resort->location = $location;
            $resort->resort_description = $resort_description;
            $resort->price = $price;
            $resort->image = 'default.png'; // Default image
            $resort->save();

            // Get the ID of the newly inserted resort
            $resort_id = $resort->resort_id;

            // Update the image if provided
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageExtension = $image->getClientOriginalExtension();
                $imageNewName = $resort_id . '.' . $imageExtension;
                $image->move(public_path('img'), $imageNewName);
                $resort->image = $imageNewName;
                $resort->save();
            }

            // Insert rooms
            if ($rooms) {
                foreach ($rooms as $room) {
                    $resortRoom = new ResortRoom();
                    $resortRoom->resort_id = $resort_id;
                    $resortRoom->room_id = $room;
                    $resortRoom->save();
                }
            }

            DB::commit();

            $response['title'] = 'Added Successfully!';
            $response['text'] = 'Resort added';
            $response['icon'] = 'success';
        } catch (\Exception $e) {
            DB::rollBack();
            $response['failed'] = 'Failed to add resort. Error: ' . $e->getMessage();
        }

        return response()->json($response);
    }
    public function addRoom(Request $request)
    {
        $room_name = $request->input('room_name');
        $room_description = $request->input('room_description');
        $response = [];

        try {
            // Check if the room name is already in use
            $existingRoom = Room::where('room_name', $room_name)->exists();
            if ($existingRoom) {
                $response['exists'] = "This room name is already in use";
                return response()->json($response);
            }

            // Create a new room
            $room = new Room([
                'room_name' => $room_name,
                'room_description' => $room_description,
            ]);

            $room->save();

            $response['title'] = 'Added Successfully!';
            $response['text'] = 'Room has been added';
            $response['icon'] = 'success';
        } catch (\Exception $e) {
            $response['failed'] = "Failed to add room. Error: " . $e->getMessage();
        }

        return response()->json($response);
    }
    public function deleteReservation(Request $request)
    {
        $reserve_id = $request->input('reserve_id');
        $response = [];

        try {
            // Retrieve reservation details
            $reservation = Reserve::find($reserve_id);

            if (!$reservation) {
                $response['error'] = "Reservation not found";
                return response()->json($response);
            }

            $del_resort_id = $reservation->resort_id;
            $del_room_id = $reservation->room_id;

            // Update status to 'not_booked' in resort_room table
            ResortRoom::where('room_id', $del_room_id)
                ->where('resort_id', $del_resort_id)
                ->update(['status' => 'not_booked']);

            // Delete reservation
            $reservation->delete();

            $response['success'] = "Reservation deleted";
        } catch (\Exception $e) {
            $response['error'] = "Failed to delete. Error: " . $e->getMessage();
        }

        return response()->json($response);
    }
    public function deleteResort(Request $request)
    {
        $resort_id = $request->input('resort_id');
        $image = $request->input('image');
        $response = [];

        try {
            // Delete reservations related to the resort
            Reserve::where('resort_id', $resort_id)->delete();

            // Delete entries from resort_room related to the resort
            ResortRoom::where('resort_id', $resort_id)->delete();

            // Delete the resort entry
            $resort = Resort::find($resort_id);
            if ($resort) {
                $resort->delete();
            }


            // If the resort had a custom image, delete it from the public folder
            if ($image != 'default.png') {
                $imagePath = public_path('img/' . $image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $response['success'] = "Resort deleted";
        } catch (\Exception $e) {

            $response['error'] = "Failed to delete resort. Error: " . $e->getMessage();
        }

        return response()->json($response);
    }
    public function deleteRoom(Request $request)
    {
        $room_id = $request->input('room_id');
        $response = [];

        try {
            // Delete reservations related to the room
            Reserve::where('room_id', $room_id)->delete();

            // Delete entries from resort_room related to the room
            ResortRoom::where('room_id', $room_id)->delete();

            // Delete the room entry
            $room = Room::find($room_id);
            if ($room) {
                $room->delete();
            }



            $response['success'] = "Room deleted";
        } catch (\Exception $e) {

            $response['error'] = "Failed to delete room. Error: " . $e->getMessage();
        }

        return response()->json($response);
    }
    public function deleteUser(Request $request)
    {
        $account_id = $request->input('account_id');
        $response = [];

        try {
            Reserve::where('account_id', $account_id)->delete();

            $user = User::find($account_id);
            if ($user) {
                // $user->relatedModel()->delete();
                $user->delete();
            }

            $response['success'] = "User deleted";
        } catch (\Exception $e) {
            $response['error'] = "Failed to delete user. Error: " . $e->getMessage();
        }

        return response()->json($response);
    }
    public function updateReservation(Request $request)
    {
        $reserve_id = $request->input('reserve_id');
        $resort_id = $request->input('resort_id');
        $room_id = $request->input('room_id');
        $account_id = $request->input('account_id');
        $date_reserved = $request->input('date_reserved');
        $response = [];

        DB::beginTransaction();

        try {
            $reserve = Reserve::findOrFail($reserve_id);

            $del_resort_id = $reserve->resort_id;
            $del_room_id = $reserve->room_id;

            // Update status to 'not_booked' for the old room
            ResortRoom::where('room_id', $del_room_id)
                ->where('resort_id', $del_resort_id)
                ->update(['status' => 'not_booked']);

            // Update reservation details
            $reserve->update([
                'resort_id' => $resort_id,
                'room_id' => $room_id,
                'account_id' => $account_id,
                'date_reserved' => $date_reserved,
            ]);

            // Update status to 'booked' for the new room
            ResortRoom::where('room_id', $room_id)
                ->where('resort_id', $resort_id)
                ->update(['status' => 'booked']);

            DB::commit();

            $response['title'] = 'Action successful!';
            $response['text'] = 'Update successful';
            $response['icon'] = 'success';
        } catch (\Exception $e) {
            DB::rollBack();
            $response['failed'] = "Failed to update. Error: " . $e->getMessage();
        }

        return response()->json($response);
    }
    public function updateResort(Request $request)
    {
        $response = [];

        DB::beginTransaction();

        try {
            $resort_id = $request->input('resort_id');
            $resort_name = $request->input('resort_name');
            $location = $request->input('location');
            $resort_description = $request->input('resort_description');
            $price = $request->input('price');
            $rooms = $request->input('room');
            $image = $request->file('image');

            $existingResort = Resort::where('resort_id', $resort_id)->first();

            // Check if the resort name already exists for other resorts
            $checkResortName = Resort::where('resort_name', $resort_name)
                ->where('resort_id', '<>', $resort_id)
                ->count();

            if ($checkResortName > 0) {
                $response['exists'] = 'Resort name is already in use';
                return response()->json($response);
            }

            // Update resort details
            $existingResort->update([
                'resort_name' => $resort_name,
                'location' => $location,
                'resort_description' => $resort_description,
                'price' => $price,
            ]);

            // Delete existing rooms
            ResortRoom::where('resort_id', $resort_id)->delete();

            // Insert new rooms
            if ($rooms) {
                foreach ($rooms as $room) {
                    ResortRoom::create([
                        'resort_id' => $resort_id,
                        'room_id' => $room,
                    ]);
                }
            }

            // Handle image upload
            if ($image) {
                $oldImage = $existingResort->image;
                $imageExtension = $image->getClientOriginalExtension();
                $imageNewName = $resort_id . '.' . $imageExtension;
                $image->move(public_path('img'), $imageNewName);

                // Delete old image if not the default one
                if ($oldImage !== 'default.png') {
                    $oldImagePath = public_path('img/' . $oldImage);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Update image in the database
                $existingResort->update(['image' => $imageNewName]);
            }

            DB::commit();

            $response['title'] = 'Updated Successfully!';
            $response['text'] = 'Resort updated';
            $response['icon'] = 'success';
        } catch (\Exception $e) {
            DB::rollBack();
            $response['failed'] = 'Failed to edit resort. Error: ' . $e->getMessage();
        }

        return response()->json($response);
    }
    public function updateRoom(Request $request)
    {
        $room_id = $request->input('room_id');
        $room_name = $request->input('room_name');
        $room_description = $request->input('room_description');
        $response = [];

        DB::beginTransaction();

        try {
            $existingRoom = Room::where('room_name', $room_name)
                ->where('room_id', '!=', $room_id)
                ->exists();

            if ($existingRoom) {
                $response['exists'] = 'This room name is already in use';
                return response()->json($response);
            }

            Room::where('room_id', $room_id)
                ->update([
                    'room_name' => $room_name,
                    'room_description' => $room_description,
                ]);

            DB::commit();

            $response['title'] = 'Updated Successfully!';
            $response['text'] = 'Room has been updated';
            $response['icon'] = 'success';
        } catch (\Exception $e) {
            DB::rollBack();
            $response['failed'] = 'Failed to update room. Error: ' . $e->getMessage();
        }

        return response()->json($response);
    }
    public function updateUser(Request $request)
    {
        $account_id = $request->input('account_id');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password');
        $contact_number = $request->input('contact_number');
        $user_type = $request->input('user_type', 'customer');
        $response = [];

        DB::beginTransaction();

        try {
            $existingEmail = User::where('email', $email)
                ->where('account_id', '!=', $account_id)
                ->exists();

            if ($existingEmail) {
                $response['exists'] = 'This email is already in use';
                return response()->json($response);
            }

            $account = User::find($account_id);
            $account->update([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'username' => $username,
                'password' => Hash::make($password),
                'contact_number' => $contact_number,
                'user_type' => $user_type,
            ]);

            DB::commit();

            $response['first_name'] = $first_name;
            $response['last_name'] = $last_name;
            $response['email'] = $email;
            $response['username'] = $username;
            $response['password'] = $password;
            $response['contact_number'] = $contact_number;
            $response['title'] = 'Action Successful!';
            $response['text'] = 'You have updated the user';
            $response['icon'] = 'success';
        } catch (\Exception $e) {
            DB::rollBack();
            $response['failed'] = 'Failed to update user. Error: ' . $e->getMessage();
        }

        return response()->json($response);
    }

    public function viewResorts(Request $request)
    {
        $resorts = [];

        DB::beginTransaction();

        try {
            if ($request->has('profile')) {
                $resort_id = $request->input('resort_id');
                $room_id = $request->input('room_id');
                $account_id = $request->has('account_id') ? $request->input('account_id') : request()->cookie('account_id');

                $resorts = Resort::select('resorts.*', 'reserve.date_reserved', 'reserve.reserve_id')
                    ->join('resort_room', 'resorts.resort_id', '=', 'resort_room.resort_id')
                    ->join('reserve', 'resort_room.resort_id', '=', 'reserve.resort_id')
                    ->where('reserve.resort_id', $resort_id)
                    ->where('reserve.room_id', $room_id)
                    ->where('reserve.account_id', $account_id)
                    ->distinct()
                    ->get();
            } elseif ($request->has('detail')) {
                $resort_id = $request->input('resort_id');

                $resorts = Room::select('rooms.*', 'resorts.*')
                    ->leftJoin('resort_room', 'rooms.room_id', '=', 'resort_room.room_id')
                    ->leftJoin('reserve', 'resort_room.room_id', '=', 'reserve.room_id')
                    ->where('resort_room.resort_id', $resort_id)
                    ->whereNull('reserve.room_id')
                    ->get();
            } else {
                $resorts = Resort::select('resorts.*')
                    ->join('resort_room', 'resorts.resort_id', '=', 'resort_room.resort_id')
                    ->distinct()
                    ->get();
            }

            foreach ($resorts as &$resort) {
                $roomData = Room::select('rooms.room_name', 'rooms.room_id', 'rooms.room_description')
                    ->join('resort_room', 'rooms.room_id', '=', 'resort_room.room_id')
                    ->where('resort_room.resort_id', $resort->resort_id)
                    ->get();

                $resort->room_name = $roomData->pluck('room_name')->toArray();
                $resort->room_id = $roomData->pluck('room_id')->toArray();
                $resort->room_description = $roomData->pluck('room_description')->toArray();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $resorts['error'] = 'Failed to view resorts. Error: ' . $e->getMessage();
        }

        return response()->json($resorts);
    }

    public function getReserves(Request $request)
    {
        $reserves = [];

        DB::beginTransaction();

        try {
            $reserveQuery = Reserve::select(
                'resorts.*',
                'rooms.*',
                'accounts.*',
                'reserve.account_id',
                'reserve.date_reserved',
                DB::raw('reserve.reserve_id')
            )
                ->join('resorts', 'resorts.resort_id', '=', 'reserve.resort_id')
                ->join('resort_room', 'resort_room.room_id', '=', 'reserve.room_id')
                ->join('rooms', 'rooms.room_id', '=', 'resort_room.room_id')
                ->join('accounts', 'accounts.account_id', '=', 'reserve.account_id');

            if ($request->has('reserve_id')) {
                $reserve_id = $request->input('reserve_id');
                $reserveQuery->where('reserve.reserve_id', '=', $reserve_id);
            } elseif ($request->has('reserves')) {
                $account_id = $request->has('account_id') ? $request->input('account_id') : request()->cookie('account_id');
                $reserveQuery->where('reserve.account_id', '=', $account_id);
            }

            $reserves = $reserveQuery->distinct()->get();

            if ($reserves->isEmpty()) {
                $reserves['no reserve'] = true;
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $reserves['error'] = 'Failed to grab reserve. Error: ' . $e->getMessage();
        }

        return response()->json($reserves);
    }
    public function getResorts(Request $request)
    {
        $resorts = [];

        DB::beginTransaction();

        try {
            if ($request->has('resortid')) {
                $resortid = $request->input('resortid');
                $resorts = Resort::where('resort_id', $resortid)->get();
            } else {
                $resorts = Resort::all();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $resorts['error'] = 'Failed to fetch resorts. Error: ' . $e->getMessage();
        }

        return response()->json($resorts);
    }
    public function getRooms(Request $request)
    {
        $rooms = [];

        DB::beginTransaction();

        try {
            if ($request->has('preview') || $request->has('edit')) {
                $resort_id = $request->input('resort_id');
                $room_id = $request->input('room_id');
                $rooms = Room::select('rooms.*')
                    ->join('resort_room', 'rooms.room_id', '=', 'resort_room.room_id')
                    ->where('resort_room.resort_id', $resort_id)
                    ->where(function ($query) use ($room_id) {
                        $query->where('status', '<>', 'booked')->orWhere('resort_room.room_id', $room_id);
                    })
                    ->get();
            } elseif ($request->has('add')) {
                $resort_id = $request->input('add');
                $rooms = Room::select('rooms.*')
                    ->join('resort_room', 'rooms.room_id', '=', 'resort_room.room_id')
                    ->where('resort_room.resort_id', $resort_id)
                    ->where('status', '<>', 'booked')
                    ->get();
            } elseif ($request->has('resort_id')) {
                $resort_id = $request->input('resort_id');
                $rooms = Room::select('rooms.*')
                    ->join('resort_room', 'rooms.room_id', '=', 'resort_room.room_id')
                    ->where('resort_room.resort_id', $resort_id)
                    ->get();
            } else {
                $rooms = Room::all();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $rooms['error'] = 'Failed to grab rooms. Error: ' . $e->getMessage();
        }

        return response()->json($rooms);
    }
    public function getUsers(Request $request)
    {
        $users = [];

        DB::beginTransaction();

        try {
            if ($request->has('reserved')) {
                $users = User::select('accounts.*')
                    ->leftJoin('reserve', 'accounts.account_id', '=', 'reserve.account_id')
                    ->where('accounts.user_type', '<>', 'admin')
                    ->where('accounts.user_type', '<>', 'in-charge')
                    ->whereNull('reserve.account_id')
                    ->distinct()
                    ->get();
            } elseif ($request->has('edit')) {
                $account_id = $request->input('account_id');
                $users = User::select('accounts.*')
                    ->leftJoin('reserve', 'accounts.account_id', '=', 'reserve.account_id')
                    ->where(function ($query) use ($account_id) {
                        $query->whereNull('reserve.account_id')->orWhere('reserve.account_id', $account_id);
                    })
                    ->where('accounts.user_type', '<>', 'admin')
                    ->where('accounts.user_type', '<>', 'in-charge')
                    ->distinct()
                    ->get();
            } elseif ($request->has('show')) {
                $account_id = request()->cookie('account_id');
                $users = User::where('account_id', $account_id)->get();
            } else {
                $users = User::orderByRaw("CASE WHEN user_type = 'admin' THEN 0 WHEN user_type = 'in-charge' THEN 1 ELSE 2 END")
                    ->get();
            }
            foreach ($users as $user) {
                $user->password = '**********';
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $users['error'] = 'Failed to fetch users. Error: ' . $e->getMessage();
        }

        return response()->json($users);
    }
    public function reserve(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'resort_id' => 'required',
            'room' => 'required|array',
            'date_reserved' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['failed' => 'Validation error', 'errors' => $validator->errors()], 422);
        }

        $resort_id = $request->input('resort_id');
        $rooms = $request->input('room');
        $account_id = $request->has('account_id') ? $request->input('account_id') : request()->cookie('account_id');
        $date_reserved = $request->input('date_reserved');
        $response = [];

        try {
            foreach ($rooms as $room_id) {
                // Check if the room is available
                $isRoomAvailable = ResortRoom::where('room_id', $room_id)
                    ->where('resort_id', $resort_id)
                    ->where('status', 'not_booked')
                    ->exists();

                if (!$isRoomAvailable) {
                    $response['failed'] = "Selected room (ID: $room_id) is not available for reservation.";
                    return response()->json($response);
                }

                // Create a reservation for each room
                $reserve = new Reserve([
                    'resort_id' => $resort_id,
                    'room_id' => $room_id,
                    'account_id' => $account_id,
                    'date_reserved' => $date_reserved,
                ]);

                $reserve->save();

                // Update the room status to 'booked'
                ResortRoom::where('room_id', $room_id)
                    ->where('resort_id', $resort_id)
                    ->update(['status' => 'booked']);
            }

            $response['title'] = 'Action successful!';
            $response['text'] = 'Reserve successful';
            $response['icon'] = 'success';
        } catch (\Exception $e) {
            $response['failed'] = "Failed to reserve. Error: " . $e->getMessage();
        }

        return response()->json($response);
    }


    public function cgetResorts(Request $request)
    {
        $resorts = Resort::all();

        if ($resorts->isEmpty()) {
            $resorts = ['resort' => []];
        } else {
            $resorts = ['resort' => $resorts];
        }

        return response()->json($resorts);
    }
}
