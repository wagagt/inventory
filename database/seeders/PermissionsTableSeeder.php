<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'basic_c_r_m_access',
            ],
            [
                'id'    => 18,
                'title' => 'crm_status_create',
            ],
            [
                'id'    => 19,
                'title' => 'crm_status_edit',
            ],
            [
                'id'    => 20,
                'title' => 'crm_status_show',
            ],
            [
                'id'    => 21,
                'title' => 'crm_status_delete',
            ],
            [
                'id'    => 22,
                'title' => 'crm_status_access',
            ],
            [
                'id'    => 23,
                'title' => 'crm_customer_create',
            ],
            [
                'id'    => 24,
                'title' => 'crm_customer_edit',
            ],
            [
                'id'    => 25,
                'title' => 'crm_customer_show',
            ],
            [
                'id'    => 26,
                'title' => 'crm_customer_delete',
            ],
            [
                'id'    => 27,
                'title' => 'crm_customer_access',
            ],
            [
                'id'    => 28,
                'title' => 'crm_note_create',
            ],
            [
                'id'    => 29,
                'title' => 'crm_note_edit',
            ],
            [
                'id'    => 30,
                'title' => 'crm_note_show',
            ],
            [
                'id'    => 31,
                'title' => 'crm_note_delete',
            ],
            [
                'id'    => 32,
                'title' => 'crm_note_access',
            ],
            [
                'id'    => 33,
                'title' => 'crm_document_create',
            ],
            [
                'id'    => 34,
                'title' => 'crm_document_edit',
            ],
            [
                'id'    => 35,
                'title' => 'crm_document_show',
            ],
            [
                'id'    => 36,
                'title' => 'crm_document_delete',
            ],
            [
                'id'    => 37,
                'title' => 'crm_document_access',
            ],
            [
                'id'    => 38,
                'title' => 'store_create',
            ],
            [
                'id'    => 39,
                'title' => 'store_edit',
            ],
            [
                'id'    => 40,
                'title' => 'store_show',
            ],
            [
                'id'    => 41,
                'title' => 'store_delete',
            ],
            [
                'id'    => 42,
                'title' => 'store_access',
            ],
            [
                'id'    => 43,
                'title' => 'admin_store_access',
            ],
            [
                'id'    => 44,
                'title' => 'provider_create',
            ],
            [
                'id'    => 45,
                'title' => 'provider_edit',
            ],
            [
                'id'    => 46,
                'title' => 'provider_show',
            ],
            [
                'id'    => 47,
                'title' => 'provider_delete',
            ],
            [
                'id'    => 48,
                'title' => 'provider_access',
            ],
            [
                'id'    => 49,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 50,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 51,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 52,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 53,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 54,
                'title' => 'product_tag_create',
            ],
            [
                'id'    => 55,
                'title' => 'product_tag_edit',
            ],
            [
                'id'    => 56,
                'title' => 'product_tag_show',
            ],
            [
                'id'    => 57,
                'title' => 'product_tag_delete',
            ],
            [
                'id'    => 58,
                'title' => 'product_tag_access',
            ],
            [
                'id'    => 59,
                'title' => 'admin_product_access',
            ],
            [
                'id'    => 60,
                'title' => 'product_create',
            ],
            [
                'id'    => 61,
                'title' => 'product_edit',
            ],
            [
                'id'    => 62,
                'title' => 'product_show',
            ],
            [
                'id'    => 63,
                'title' => 'product_delete',
            ],
            [
                'id'    => 64,
                'title' => 'product_access',
            ],
            [
                'id'    => 65,
                'title' => 'products_base_create',
            ],
            [
                'id'    => 66,
                'title' => 'products_base_edit',
            ],
            [
                'id'    => 67,
                'title' => 'products_base_show',
            ],
            [
                'id'    => 68,
                'title' => 'products_base_delete',
            ],
            [
                'id'    => 69,
                'title' => 'products_base_access',
            ],
            [
                'id'    => 70,
                'title' => 'product_spec_create',
            ],
            [
                'id'    => 71,
                'title' => 'product_spec_edit',
            ],
            [
                'id'    => 72,
                'title' => 'product_spec_show',
            ],
            [
                'id'    => 73,
                'title' => 'product_spec_delete',
            ],
            [
                'id'    => 74,
                'title' => 'product_spec_access',
            ],
            [
                'id'    => 75,
                'title' => 'item_create',
            ],
            [
                'id'    => 76,
                'title' => 'item_edit',
            ],
            [
                'id'    => 77,
                'title' => 'item_show',
            ],
            [
                'id'    => 78,
                'title' => 'item_delete',
            ],
            [
                'id'    => 79,
                'title' => 'item_access',
            ],
            [
                'id'    => 80,
                'title' => 'admin_transaction_access',
            ],
            [
                'id'    => 81,
                'title' => 'transaction_status_create',
            ],
            [
                'id'    => 82,
                'title' => 'transaction_status_edit',
            ],
            [
                'id'    => 83,
                'title' => 'transaction_status_show',
            ],
            [
                'id'    => 84,
                'title' => 'transaction_status_delete',
            ],
            [
                'id'    => 85,
                'title' => 'transaction_status_access',
            ],
            [
                'id'    => 86,
                'title' => 'transaction_type_create',
            ],
            [
                'id'    => 87,
                'title' => 'transaction_type_edit',
            ],
            [
                'id'    => 88,
                'title' => 'transaction_type_show',
            ],
            [
                'id'    => 89,
                'title' => 'transaction_type_delete',
            ],
            [
                'id'    => 90,
                'title' => 'transaction_type_access',
            ],
            [
                'id'    => 91,
                'title' => 'transaction_create',
            ],
            [
                'id'    => 92,
                'title' => 'transaction_edit',
            ],
            [
                'id'    => 93,
                'title' => 'transaction_show',
            ],
            [
                'id'    => 94,
                'title' => 'transaction_delete',
            ],
            [
                'id'    => 95,
                'title' => 'transaction_access',
            ],
            [
                'id'    => 96,
                'title' => 'transaction_detail_create',
            ],
            [
                'id'    => 97,
                'title' => 'transaction_detail_edit',
            ],
            [
                'id'    => 98,
                'title' => 'transaction_detail_show',
            ],
            [
                'id'    => 99,
                'title' => 'transaction_detail_delete',
            ],
            [
                'id'    => 100,
                'title' => 'transaction_detail_access',
            ],
            [
                'id'    => 101,
                'title' => 'customer_charge_account_create',
            ],
            [
                'id'    => 102,
                'title' => 'customer_charge_account_edit',
            ],
            [
                'id'    => 103,
                'title' => 'customer_charge_account_show',
            ],
            [
                'id'    => 104,
                'title' => 'customer_charge_account_delete',
            ],
            [
                'id'    => 105,
                'title' => 'customer_charge_account_access',
            ],
            [
                'id'    => 106,
                'title' => 'admin_survey_access',
            ],
            [
                'id'    => 107,
                'title' => 'survey_ubication_create',
            ],
            [
                'id'    => 108,
                'title' => 'survey_ubication_edit',
            ],
            [
                'id'    => 109,
                'title' => 'survey_ubication_show',
            ],
            [
                'id'    => 110,
                'title' => 'survey_ubication_delete',
            ],
            [
                'id'    => 111,
                'title' => 'survey_ubication_access',
            ],
            [
                'id'    => 112,
                'title' => 'survey_create',
            ],
            [
                'id'    => 113,
                'title' => 'survey_edit',
            ],
            [
                'id'    => 114,
                'title' => 'survey_show',
            ],
            [
                'id'    => 115,
                'title' => 'survey_delete',
            ],
            [
                'id'    => 116,
                'title' => 'survey_access',
            ],
            [
                'id'    => 117,
                'title' => 'survey_detail_create',
            ],
            [
                'id'    => 118,
                'title' => 'survey_detail_edit',
            ],
            [
                'id'    => 119,
                'title' => 'survey_detail_show',
            ],
            [
                'id'    => 120,
                'title' => 'survey_detail_delete',
            ],
            [
                'id'    => 121,
                'title' => 'survey_detail_access',
            ],
            [
                'id'    => 122,
                'title' => 'survey_ask_type_create',
            ],
            [
                'id'    => 123,
                'title' => 'survey_ask_type_edit',
            ],
            [
                'id'    => 124,
                'title' => 'survey_ask_type_show',
            ],
            [
                'id'    => 125,
                'title' => 'survey_ask_type_delete',
            ],
            [
                'id'    => 126,
                'title' => 'survey_ask_type_access',
            ],
            [
                'id'    => 127,
                'title' => 'survey_responder_create',
            ],
            [
                'id'    => 128,
                'title' => 'survey_responder_edit',
            ],
            [
                'id'    => 129,
                'title' => 'survey_responder_show',
            ],
            [
                'id'    => 130,
                'title' => 'survey_responder_delete',
            ],
            [
                'id'    => 131,
                'title' => 'survey_responder_access',
            ],
            [
                'id'    => 132,
                'title' => 'survey_response_create',
            ],
            [
                'id'    => 133,
                'title' => 'survey_response_edit',
            ],
            [
                'id'    => 134,
                'title' => 'survey_response_show',
            ],
            [
                'id'    => 135,
                'title' => 'survey_response_delete',
            ],
            [
                'id'    => 136,
                'title' => 'survey_response_access',
            ],
            [
                'id'    => 137,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
