<?php

namespace App\Http\Controllers;
use App\Alumuni;
use App\Teacher;
use Illuminate\Http\Request;
use App\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
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

    //

    public function get(){
            echo 'hello';
    }


        public function store(Request $request)
        {
            //

            $grouped = collect($request->all())->flatMap(function ($item, $key) {
                return [Str::snake($key) => $item];
            });

            $request_update = $grouped->toArray();

//           dd(($request_update));
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
                return response()->json($response);
            }
            try {
                //todo:: for student
                if($request->userType == 1){
//                    dd('i am 1');
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
                    return response()->json($student);
                }

                //todo:: for Alumuni and teacher
                if($request->userType == 2){
                    if ($request->isChecked == true){
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
                        'department' => $request_update['department'],
                        'teacher_id' => $request_update['teacher_id']
                    ];

                    $teacher = Teacher::updateOrCreate(['teacher_id'=>$data['teacher_id']],$data);

                }

                //todo:: for aolumuni
                if($request->userType == 3){
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
                    $student = Alumuni::updateOrCreate(['admission_no'=>$data['admission_no']],$data);
                    return response()->json($student);
                }
                else{
                    dd('i am co-ordinator');
                }



                //todo:use either create or update based on presence of "id" and do on validation also.
                /*if ($request->id == null){
                    $student = Student::create($request_update);
                    $student->save();
                }
                else{
                    $student = Student::find($request_update->id);
                    $student->update($request_update);
                    $student->save();
                }
                //todo:remove status code, desc etc. make it like the one DepartmentController
                if(filled($student)) {
                    return response()->json(true);
                }
                return response()->json(false);*/




            }
            catch( QueryException  $exception){
                return response()->json(['errors'=>$exception->errorInfo]);
            }
        }

}