<?php 

namespace Plafor\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class AcquisitionStatusModel extends Model{
    private static $acquisitionStatusModel=null;
    protected $table='acquisition_status';
    protected $primaryKey='id';
    protected $allowedFields=['fk_objective','fk_user_course','fk_acquisition_level'];
    private $objectiveModel=null;
    private $userCourseModel=null;
    private $acquisitionLevelModel=null;

    /**
     * @return AcquisitionStatusModel
     */
    public static function getInstance(){
        if (AcquisitionStatusModel::$acquisitionStatusModel==null) {
            AcquisitionStatusModel::$acquisitionStatusModel = new AcquisitionStatusModel();
        }
        return AcquisitionStatusModel::$acquisitionStatusModel;
    }
    /**
     * @param $fkObjectiveId /the id of the fk_objective
     * @return array|null
     */
    public static function getObjective($fkObjectiveId){
        return ObjectiveModel::getInstance()->find($fkObjectiveId);

    }
    /**
     * @param $fkUserCourseId /the id of the fk_user_course
     * @return array|null
     */
    public static function getUserCourse($fkUserCourseId){
        return UserCourseModel::getInstance()->find($fkUserCourseId);

    }
    /**
     * @param $fkAcquisitionLevelId /the id of the fk_aquisition_level
     * @return array|null
     */
    public function getAcquisitionLevel($fkAcquisitionLevelId){
        return AcquisitionLevelModel::getInstance()->find($fkAcquisitionLevelId);

    }
}






?>