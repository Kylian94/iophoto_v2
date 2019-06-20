<?php

    namespace App\Http\Controllers;

    use Auth;
    use App\User;
    use Validator;
    use Illuminate\Http\Request;

    class UserController extends Controller
    {
        public function index()
        {
            return response()->json(User::with(['orders'])->get());
        }

        public function login(Request $request)
        {
            $status = 401;
            $response = ['error' => 'Unauthorised'];

            if (Auth::attempt($request->only(['email', 'password']))) {
                $status = 200;
                $response = [
                    'user' => Auth::user(),
                    'token' => Auth::user()->createToken('IophotoStore')->accessToken,
                ];
            } 

            return response()->json($response, $status);
        }

        public function register(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:50',
                'email' => 'required|email',
                'password' => 'required|min:6',
                'c_password' => 'required|same:password',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }

            $data = $request->only(['name', 'email', 'password']);
            $data['password'] = bcrypt($data['password']);

            $user = User::create($data);
            $user->is_admin = 0;

            return response()->json([
                'user' => $user,
                'token' => $user->createToken('IophotoStore')->accessToken,
            ]);
        }

        public function show(User $user)
        {
            return response()->json($user);
        }

        public function showOrders(User $user)
        {
            return response()->json($user->carts()->with(['order'])->get());
        }

        public function store(Request $request)
        {
            
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'is_admin' => $request->is_admin,
                'orders' => 0,
            ]);

            return response()->json([
                'status' => (bool) $user,
                'data'   => $user,
                'message' => $user ? 'User Created!' : 'Error Creating User'
            ]);
        }

        public function update(Request $request, User $user)
        {
            $status = $user->update(
                $request->only(['name', 'email', 'is_admin'])
            );

            return response()->json([
                'status' => $status,
                'message' => $status ? 'user Updated!' : 'Error Updating user'
            ]);
        }

        public function destroy(User $user)
        {
            $status = $user->delete();

            return response()->json([
                'status' => $status,
                'message' => $status ? 'User Deleted!' : 'Error Deleting User'
            ]);
        }
    }
