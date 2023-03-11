<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiMessage extends Model
{
    use HasFactory;

    public function messages($req)
    {
        $messages = array(

            // Token
            'error_request_token_invalid' => "Request token missing.",
            'error_auth_token_invalid' => "Your session has been expired. Please log in again.",
            
            // Validation
            'success_validation_ok' => "Validation OK.",
            'success_success' => "Success!!",
            
            // Param Validation
            'error_user_not_register' => "Please fill up the form and send it to us",
            'error_phone_number_missing' => 'Please enter phone number',
            'error_phone_number_min_max_length_violate' => 'The phone number must be a minimum length of 10 characters.',
            'error_uid_missing' => 'Please enter user id',
            'error_latitude_missing' => 'Please enter latitude',
            'error_longitude_missing' => 'Please enter longitude',
            'error_type_of_job_required_missing' => 'Please enter type of job required',
            'error_skill_set_missing' => 'Please enter skill set',
            'error_work_experience_missing' => 'Please enter work experience',
            'error_name_missing' => 'Please enter name',
            'error_gender_missing' => 'Please enter gender',
            'error_self_picture_missing' => 'Please enter self picture',
            'error_age_missing' => 'Please enter age',
            'error_education_missing' => 'Please enter education',
            'error_documents_missing' => 'Please enter documents',
            'error_type_of_employement_missing' => 'Please enter type of employement',
            'error_expected_salary_range_missing' => 'Please enter expected salary range',
            'error_email_id_missing' => 'Please enter email id',
            'error_employer_name_missing' => 'Please enter employer name',
            'error_designation_missing' => 'Please enter designation',
            'error_organization_name_missing' => 'Please enter organization name',
            'error_organization_type_missing' => 'Please enter organization type',
            'error_organization_email_id_missing' => 'Please enter organization email id',
            'error_organization_headquarters_missing' => 'Please enter organization headquarters',
            'error_categories_hiring_missing' => 'Please enter categories hiring',
            'error_cities_hiring_missing' => 'Please enter cities hiring',
            'error_unit_hiring_for_missing' => 'Please enter unit hiring for',
            'error_unit_name_missing' => 'Please enter unit name',
            'error_unit_address_missing' => 'Please enter unit address',
            'error_unit_poc_name_missing' => 'Please enter unit poc name',
            'error_unit_poc_contact_number_missing' => 'Please enter unit poc contact number',
            'error_unit_poc_contact_number_min_max_length_violate' => 'The contact number must be a minimum length of 10 characters.',
            'error_unit_poc_email_id_missing' => 'Please enter unit poc email id',
            'error_gst_number_missing' => 'Please enter gst number',
            'error_gst_certificate_missing' => 'Please enter gst certificate',
            'error_organization_size_missing' => 'Please enter organization size',
            'error_product_type_missing' => 'Please enter product type',
            'error_unit_gst_number_missing' => 'Please enter unit gst number',
            'error_unit_location_missing' => 'Please enter unit location',
            'error_job_role_missing' => 'Please enter job role',
            'error_specialization_missing' => 'Please enter specialization',
            'error_no_of_job_openings_for_this_role_missing' => 'Please enter no of job openings for this role',
            'error_salary_range_missing' => 'Please enter salary range',
            'error_job_type_missing' => 'Please enter job type',
            'error_job_location_missing' => 'Please enter job location',
            'error_state_domicile_missing' => 'Please enter state domicile',
            'error_do_you_want_to_share_contact_no_with_employee_missing' => 'Please enter do you want to share contact no with employee',
            'error_mode_of_contact_missing' => 'Please enter mode of contact',
            'error_poc_name_missing' => 'Please enter poc name',
            'error_poc_contact_number_missing' => 'Please enter poc contact number',
            'error_poc_email_id_missing' => 'Please enter poc email id',
            'error_type_missing' => 'Please enter type',
            'error_type_max_length_violate' => 'Please enter valid type',
            'error_profile_all_ready_created' => 'Profile all ready created',
            'error_invalid_email' => 'Please enter valid email id',
            'error_invalid_gst' => 'Please enter valid GST id',

            // Image - Video
            'error_invalid_image_extension' => 'Select only image file.',
            'error_invalid_video_extension' => 'Select only video file.'
        );
        foreach ($messages as $key => $message) {
            if ($req == $key) {
                return $message;
            }
        }
    }
}
