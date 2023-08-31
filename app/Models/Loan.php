<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use HasFactory, SoftDeletes;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'loan';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'loan_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['borrower_id','loan_type_id','ammount_applied','application_date','credit_union_id','bdo','cu_decision','signed_credit_memo','signed_commitment_letter'
                            ,'employee','loan_amount','application_submitted_incomplete','credit_memo','ocatant_recommendation','uw_base_fee','uw_additional_fee_comments'
                        , 'uw_incomplete_start', 'uw_incomplete_finish','appraisal_and_env_ordered','appraisal_and_env_complete','closing_process', 'anticipated_close_date','status','date_closed', 'serviced_loan'];


    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'label' => 'array',
        'waived' => 'array',
        'satisfied' => 'array',
        'sort' => 'array',
        'loan_amount' => 'float',
        'amount_applied' => 'float',
        'uw_additional_fee_comments' => 'float'
    ];
}
