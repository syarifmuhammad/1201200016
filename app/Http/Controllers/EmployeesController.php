<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'employeeNumber' => 'required|unique:employees',
            'lastName' => 'required',
            'firstName' => 'required',
            'extension' => 'required',
            'email' => 'required',
            'officeCode' => 'required|exists:offices',
            'reportsTo' => 'required|exists:employees',
            'jobTitle' => 'required'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => 'Employee creation failed',
                'errors' => $validate->errors()
            ], 400);
        }

        try {
            $employee = new Employee();
            $employee->employeeNumber = $request->employeeNumber;
            $employee->lastName = $request->lastName;
            $employee->firstName = $request->firstName;
            $employee->extension = $request->extension;
            $employee->email = $request->email;
            $employee->officeCode = $request->officeCode;
            $employee->reportsTo = $request->reportsTo;
            $employee->jobTitle = $request->jobTitle;
            $employee->save();

            return response()->json([
                'message' => 'Employee created successfully',
                'employee' => $employee
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Employee creation failed: ' . $e->getMessage()
            ], 409);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json([
                'message' => 'Employee not found'
            ], 404);
        }

        return response()->json($employee, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json([
                'message' => 'Employee not found'
            ], 404);
        }

        $validate = Validator::make($request->all(), [
            'employeeNumber' => 'unique:employees,employeeNumber,' . $id . ',employeeNumber',
            'officeCode' => 'exists:offices',
            'reportsTo' => 'exists:employees',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => 'Employee update failed',
                'errors' => $validate->errors()
            ], 400);
        }

        try {
            DB::table('employees')->where('employeeNumber', '=', $id)->update($request->all());
            return response()->json([
                'message' => 'Employee updated successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Employee update failed: ' . $e->getMessage()
            ], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json([
                'message' => 'Employee not found'
            ], 404);
        }

        try {
            DB::table('employees')->where('employeeNumber', '=', $id)->delete();
            return response()->json([
                'message' => 'Employee deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Employee deletion failed: ' . $e->getMessage()
            ], 409);
        }
    }
}
