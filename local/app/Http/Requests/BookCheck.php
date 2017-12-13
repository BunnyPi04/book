<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookCheck extends FormRequest
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
            'sku' => 'required|min:8|max:8',
            'book_name' => 'required|max:50',
            'publisher_id' => 'required',
            'author' => 'required|max:50',
            'images' => 'image',
            'category' => 'required',
            'price' => 'required',
            'description' => 'required'
        ];
    }

    public function messages() {
        return [
            'sku.required' => 'Mã sách SKU không được để trống!',
            'min' => 'SKU phải là 8 ký tự!',
            'sku.max' => 'SKU phải là 8 ký tự',
            'book_name.required' => 'Không được để trống tên sách!',
            'book_name.max' => 'Tên sách phải ít hơn 50 ký tự!',
            'publisher_id.required' => 'Không được để trống Nhà xuất bản!',
            'author.required' => 'Không được để trống tên tác giả!',
            'author.max' => 'Tên tác giả phải ít hơn 50 ký tự',
            'images.image' => 'Hình ảnh phải đúng định dạng (jpeg/ png/ bmp/ gif/ svg)!',
            'category.required' => 'Không được để trống thể loại sách!',
            'price.required' => 'Không được để trống giá bìa của sách!',
            'description.required' => 'Sách cần có phần giới thiệu!'
        ];
    }
}
