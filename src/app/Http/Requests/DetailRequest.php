<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'clock_in' => ['required','date_format:H:i',function($attribute,$value,$fail){
                $clockOut = $this->input('clock_out');
                if($clockOut && strtotime($value) >= strtotime($clockOut)){
                    $fail('出勤時間もしくは退勤時間が不適切な値です');
                }
            }],
            'clock_out' => ['required','date_format:H:i',function($attribute,$value,$fail){
                $clockIn = $this->input('clock_in');
                if($clockIn && strtotime($value) <= strtotime($clockIn)){
                    $fail('出勤時間もしくは退勤時間が不適切な値です');
                }
            }],
            'breaks.*.start' => ['nullable','date_format:H:i',function($attribute,$value,$fail){
                $clockIn = $this->input('clock_in');
                $clockOut = $this->input('clock_out');
                if($value){
                    if($clockIn && strtotime($value) < strtotime($clockIn)){
                        $fail('休憩時間が不適切な値です');
                    }
                    if($clockOut && strtotime($value) > strtotime($clockOut)){
                        $fail('休憩時間が不適切な値です');
                    }
                }
            }],
            'breaks.*.end' => ['nullable', 'date_format:H:i', function($attribute, $value, $fail) {
                $clockOut = $this->input('clock_out');
                $index = explode('.', $attribute)[1] ?? null;
                $breakStart = $this->input("breaks.$index.start");
                // $breakStart = $this->input('break_start');
                if ($value) {
                    if($breakStart && strtotime($value) <= strtotime($breakStart)){
                        $fail('休憩時間が不適切な値です');
                    }
                    if ($clockOut && strtotime($value) > strtotime($clockOut)) {
                        $fail('休憩時間もしくは退勤時間が不適切な値です');
                    }
                }
            }],
            'remarks' => ['required' , 'max:255'],
        ];
    }

    public function messages()
    {
        return[
            'clock_in.required' => '出勤時間を入力してください。',
            'clock_in.date_format' => '出勤時間はHH:MM形式で入力してください。',
            'clock_out.required' => '退勤時間を入力してください。',
            'clock_out.date_format' => '退勤時間はHH:MM形式で入力してください。',
            'break.*.start.date_format' => '休憩開始時間はHH:MM形式で入力してください。',
            'break.*.end.date_format' => '休憩終了時間はHH:MM形式で入力してください。',
            'remarks.required' => '備考を記入してください',
            'remarks.max' => '備考は255文字以内で入力してください。',
        ];
    }
}
