<?php

namespace App\Http\Controllers;
use App\Alumuni;
use App\Coordinator;
use App\Teacher;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
class CustomController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function get(){
            echo 'hello';
    }


        public function store(Request $request)
        {
            $grouped = collect($request->all())->flatMap(function ($item, $key) {
                return [Str::snake($key) => $item];
            });
            $request_update = $grouped->toArray();
            /*dd($request_update);*/
            $validator = Validator::make($request->all(), [
                'firstName' => 'required_without:id|alpha',
                'lastName' => 'alpha',
                'dateOfBirth' => 'date',
                'subject' => 'alpha',
                'email' => 'required_without:id|email',
                'phoneNumber' => 'required_without:id|numeric|digits:10|starts_with:1,2,3,4,5,6,7,8,9',
                'address' => 'nullable|string',
                'gender' => 'alpha',
                'admissionNo' => 'string',
                'department' => 'alpha',
                'teacherId' => 'string',
                'releavingDate' => 'date',
                'userType' => 'string'
            ]);
            if ($validator->fails()) {
                $response['errors'] = $validator->errors();
                $response["Validation Error"] = 'Error';
                return response()->json($response);

                /*return response()->json($response);*/
            }
            try {
                //todo:: for student
                if($request->userType == 1){
                    $statusModel = new Student();
                    $fields = $request->only($statusModel->getFillable());
                    $statusModel->fill($fields);
                    $data = [
                      'first_name' => $request_update['first_name'] ,
                      'last_name' => $request_update['last_name'],
                      'date_of_birth' => $request_update['date_of_birth'],
                      'subject' => $request_update['subject'],
                      'phone_number' => $request_update['phone_number'],
                      'email' => $request_update['email'],
                      'gender' =>$request_update['gender'],
                      'address' => $request_update['address'],
                      'joinning_date' => $request_update['joinning_date'],
                      'admission_no' => $request_update['admission_no']
                    ];
                    $student = Student::updateOrCreate(['admission_no'=>$data['admission_no']],$data);
                    /*return response()->json($student);*/
                    $response["true"] = 'student Created';
                    return response()->json($response);
                }
                //todo:: for teacher and alumuni
                if($request->userType == 3){
                    if ($request->isChecked == 1){
                        /*dd('i am in checked');*/
                        $statusModel = new Alumuni();
                        $fields = $request->only($statusModel->getFillable());
                        $statusModel->fill($fields);
                        $data = [
                            'first_name' => $request_update['first_name'] ,
                            'last_name' => $request_update['last_name'],
                            'date_of_birth' => $request_update['date_of_birth'],
                            'subject' => $request_update['subject'],
                            'phone_number' => $request_update['phone_number'],
                            'email' => $request_update['email'],
                            'gender' =>$request_update['gender'],
                            'address' => $request_update['address'],
                            'releaving_date' => $request_update['releaving_date'],
                            'admission_no' => $request_update['admission_no']
                        ];
                        $alumuni = Alumuni::updateOrCreate(['admission_no'=>$data['admission_no']],$data);
                    }
                    $statusModel = new Teacher();
                    $fields = $request->only($statusModel->getFillable());
                    $statusModel->fill($fields);
                    $data = [
                        'first_name' => $request_update['first_name'] ,
                        'last_name' => $request_update['last_name'],
                        'date_of_birth' => $request_update['date_of_birth'],
                        'subject' => $request_update['subject'],
                        'phone_number' => $request_update['phone_number'],
                        'email' => $request_update['email'],
                        'gender' =>$request_update['gender'],
                        'address' => $request_update['address'],
                        'department_no' => $request_update['department_no'],
                        'teacher_id' => $request_update['teacher_id']
                    ];
                    $teacher = Teacher::updateOrCreate(['teacher_id'=>$data['teacher_id']],$data);
                    /*return response()->json($teacher);*/
                    $response["true"] = 'Teacher Created';
                    return response()->json($response);
                }
                //todo:: for aolumuni
                if($request->userType == 2){
                    $statusModel = new Alumuni();
                    $fields = $request->only($statusModel->getFillable());
                    $statusModel->fill($fields);
                    $data = [
                        'first_name' => $request_update['first_name'] ,
                        'last_name' => $request_update['last_name'],
                        'date_of_birth' => $request_update['date_of_birth'],
                        'subject' => $request_update['subject'],
                        'phone_number' => $request_update['phone_number'],
                        'email' => $request_update['email'],
                        'gender' =>$request_update['gender'],
                        'address' => $request_update['address'],
                        'releaving_date' => $request_update['releaving_date'],
                        'admission_no' => $request_update['admission_no']
                    ];
                    $alumuni = Alumuni::updateOrCreate(['admission_no'=>$data['admission_no']],$data);
                    /*return response()->json($alumuni);*/
                    $response["true"] = 'alumuni Created';
                    return response()->json($response);
                }
                if($request->userType == 4){
                    $statusModel = new Coordinator();
                    $fields = $request->only($statusModel->getFillable());
                    $statusModel->fill($fields);
                    $data = [
                        'first_name' => $request_update['first_name'] ,
                        'last_name' => $request_update['last_name'],
                        'date_of_birth' => $request_update['date_of_birth'],
                        'phone_number' => $request_update['phone_number'],
                        'email' => $request_update['email'],
                        'gender' =>$request_update['gender'],
                        'address' => $request_update['address'],
                        'coordiantor_id' => $request_update['coordiantor_id'],
                    ];
                    $coordinator = Coordinator::updateOrCreate(['coordiantor_id'=>$data['coordiantor_id']],$data);
                    /*return response()->json($coordinator);*/
                    $response["true"] = 'CoOrdinator Created';
                    return response()->json($response);
                }
            }
            //todo: error
            catch( QueryException  $exception){
                /*return response()->json(['errors'=>$exception->errorInfo]);*/
                $response['errorNew'] = response()->json($exception);
                return response()->json(['errors'=>$response]);
            }
        }
}
