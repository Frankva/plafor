<?php

namespace Plafor\Models;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;

class GradeModelTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    // For Migrations
    protected $migrate     = true;
    protected $migrateOnce = false;
    protected $refresh     = true;
    protected $namespace   = null;

    // For Seeds
    protected $seedOnce = false;
    protected $seed     = 'gradeModelTestSeed';
    protected $basePath = 'tests/_support/Database';

    /**
     * Verifies the creation of a GradeModel instance.
     */
    public function testGradeModelInstance(): void
    {
        $gradeModel = model('GradeModel');
        $this->assertTrue($gradeModel instanceof GradeModel);
        $this->assertInstanceOf(GradeModel::class, $gradeModel);
    }

    /**
     * Tests the retrieval of a single record by ID using the find method.
     * (school subject)
     */
    public function testFindExpectSubject(): void
    {
        $id = 1;
        $gradeModel = model('GradeModel');
        $data = $gradeModel->find($id);
        $expect = [
            'id' => $id,
            'fk_user_course' => '1',
            'fk_teaching_subject' => '1',
            'date' => '2024-08-22',
            'grade' => '4.0',
            'is_school' => '1',
            'archive' => null,
            'teaching_subject_name' => 'Mathématiques',
            'user_id' => 6,
        ];
        $this->assertEquals($expect, $data);
    }

    /**
     * Tests the retrieval of a single record by ID using the find method.
     * (module)
     */
    public function testFindExpectModule(): void
    {
        $id = 2;
        $gradeModel = model('GradeModel');
        $data = $gradeModel->find($id);
        $expect = [
            'id' => $id,
            'fk_user_course' => '1',
            'date' => '2024-08-23',
            'grade' => '4.5',
            'is_school' => '1',
            'archive' => null,
            'fk_teaching_module' => '1',
            'teaching_module_name' => 'Interroger, traiter et assurer la '
                . 'maintenance des bases de données',
            'user_id' => 6,
        ];
        $this->assertEquals($expect, $data);
    }

    /**
     * Tests the retrieval of all records using the findAll method.
     */
    public function testFindAll(): void
    {
        $gradeModel = model('GradeModel');
        $data = $gradeModel->findAll();
        $this->assertIsArray($data);
        $this->assertEquals(1, $data[0]['id']);
        $this->assertEquals(2, $data[1]['id']);
    }

    /**
     * Tests the retrieval of the first record using the first method.
     */
    public function testFirst(): void
    {
        $gradeModel = model('GradeModel');
        $data = $gradeModel->first();
        $expect = [
            'id' => '1',
            'fk_user_course' => '1',
            'fk_teaching_subject' => '1',
            'date' => '2024-08-22',
            'grade' => '4.0',
            'is_school' => '1',
            'archive' => null,
            'teaching_subject_name' => 'Mathématiques',
            'user_id' => 6,
        ];
        $this->assertEquals($expect, $data);
    }

     /**
     * Tests the retrieval of the first record using the first method.
     */   
    public function testFirstCustom(): void
    {
        $gradeModel = model('GradeModel');
        $data = $gradeModel->select('grade')->first();
        $expect = [
            'grade' => 4,
        ];
        $this->assertEquals($expect, $data);
    }

    /**
     * Tests the insertion of a new subject grade using the insert method.
     */
    public function testInsertSubject(): void
    {
        $gradeModel = model('GradeModel');
        $grade = [
            'fk_user_course' => '1',
            'fk_teaching_subject' => '1',
            'date' => '2024-08-23',
            'grade' => '4.0',
            'is_school' => '1',
            'archive' => null,
            'teaching_subject_name' => 'Mathématiques',
        ];
        $isSuccess = $gradeModel->insert($grade, false);
        $this->assertTrue($isSuccess);
    }

    /**
     * Tests the insertion of a new module grade using the insert method.
     */
    public function testInsertModule(): void
    {
        $gradeModel = model('GradeModel');
        $grade = [
            'fk_user_course' => '1',
            'fk_teaching_module' => '1',
            'date' => '2024-08-23',
            'grade' => '4.0',
            'is_school' => '1',
            'archive' => null,
            'teaching_module_name' => 'Interroger'
        ];
        $isSuccess = $gradeModel->insert($grade, false);
        $this->assertTrue($isSuccess);
    }

    /**
     * Tests the insertion of a new invalide subject and module grade using the
     * insert method.
     */
    public function testInsertSubjectAndModule(): void
    {
        $gradeModel = model('GradeModel');
        $grade = [
            'fk_user_course' => '1',
            'fk_teaching_subject' => '1',
            'fk_teaching_module' => '1',
            'date' => '2024-08-23',
            'grade' => '4.0',
            'is_school' => '1',
            'archive' => null,
            'teaching_subject_name' => 'Mathématiques',
            'teaching_module_name' => 'Interroger'
        ];
        $isSuccess = $gradeModel->insert($grade, false);
        $this->assertFalse($isSuccess);
    }


    /**
     * Tests the insertion of a new grade with no subject and no module
     * using the insert method.
     */
    public function testInsertWithoutSubjectAndModule(): void
    {
        $gradeModel = model('GradeModel');
        $grade = [
            'fk_user_course' => '1',
            'date' => '2024-08-23',
            'grade' => '4.0',
            'is_school' => '1',
            'archive' => null,
        ];
        $isSuccess = $gradeModel->insert($grade, false);
        $this->assertFalse($isSuccess);
    }

    /**
     * Tests the retrieval of apprentice subject grades.
     * @covers GradeModel::getApprenticeSubjectGrades
     */
    public function testGetApprenticeSubjectGrades(): void
    {
        $gradeModel = model('GradeModel');
        $data = $gradeModel->getApprenticeSubjectGrades(1, 1);
        $expect = [
            0 => [
                'fk_user_course' => '1',
                'fk_teaching_subject' => '1',
                'date' => '2024-08-22',
                'grade' => '4.0',
                'archive' => null,
                'name' => 'Mathématiques'
            ],
            1 => [
                'fk_user_course' => '1',
                'fk_teaching_subject' => '1',
                'date' => '2024-08-22',
                'grade' => '4.5',
                'archive' => null,
                'name' => 'Mathématiques'
            ]
        ];
        $this->assertEquals($expect, $data);
    }

    /**
     * Tests the retrieval of apprentice module grades for school grades.
     *
     * @covers GradeModel::getApprenticeModulesGrades
     */
    public function testGetApprenticeModulesGradesIsSchool(): void
    {
        $id_user_course = 1;
        $is_school = true;

        $gradeModel = model('GradeModel');
        $data = $gradeModel->getApprenticeModulesGrades($id_user_course,
            $is_school);

        $expect = [
            0 => [
                'fk_user_course' => '1',
                'fk_teaching_module' => '1',
                'date' => '2024-08-23',
                'grade' => '4.5',
                'archive' => null,
                'official_name' => 'Interroger, traiter et assurer la'
                . ' maintenance des bases de données'
            ],
            1 => [
                'fk_user_course' => '1',
                'fk_teaching_module' => '2',
                'date' => '2024-08-23',
                'grade' => '5.0',
                'archive' => null,
                'official_name' => 'Mettre en œuvre des solutions ICT avec la'
                . ' technologie blockchain'
            ]
        ];
        $this->assertEquals($expect, $data);

    }

    /**
     * Tests the retrieval of apprentice module grades for non-school
     * (interentreprises) grades.
     *
     * @covers GradeModel::getApprenticeModulesGrades
     */
    public function testGetApprenticeModulesGradesIsNotSchool(): void
    {
        $id_user_course = 1;
        $is_school = false;

        $gradeModel = model('GradeModel');
        $data = $gradeModel->getApprenticeModulesGrades($id_user_course,
            $is_school);

        $expect = [
            0 => [
                'fk_user_course' => '1',
                'fk_teaching_module' => '3',
                'date' => '2024-08-23',
                'grade' => '3.0',
                'archive' => null,
                'official_name' => 'Exploiter et surveiller des services dans'
                . ' le cloud public'
            ],
        ];
        $this->assertEquals($expect, $data);

    }

    /**
     * Tests the retrieval of apprentice module grades for all grades.
     *
     * @covers GradeModel::getApprenticeModulesGrades
     */
    public function testGetApprenticeModulesGradesIsSchoolNull(): void
    {
        $id_user_course = 1;
        $is_school = null;

        $gradeModel = model('GradeModel');
        $data = $gradeModel->getApprenticeModulesGrades($id_user_course,
            $is_school);

        $expect = [
            0 => [
                'fk_user_course' => '1',
                'fk_teaching_module' => '1',
                'date' => '2024-08-23',
                'grade' => '4.5',
                'archive' => null,
                'official_name' => 'Interroger, traiter et assurer la'
                . ' maintenance des bases de données',
               'is_school' => '1'
            ],
            1 => [
                'fk_user_course' => '1',
                'fk_teaching_module' => '2',
                'date' => '2024-08-23',
                'grade' => '5.0',
                'archive' => null,
                'official_name' => 'Mettre en œuvre des solutions ICT avec la'
                    . ' technologie blockchain',
               'is_school' => '1'
            ],
            2 => [
                'fk_user_course' => '1',
                'fk_teaching_module' => '3',
                'date' => '2024-08-23',
                'grade' => '3.0',
                'archive' => null,
                'official_name' => 'Exploiter et surveiller des services dans'
                    . ' le cloud public',
                'is_school' => '0'
            ],
        ];
        $this->assertEquals($expect, $data);

    }

    /**
     * Tests the retrieval of apprentice module grade.
     *
     * @covers GradeModel::getApprenticeModuleGrade
     */
    public function testGetApprenticeModuleGrade(): void
    {
        $id_user_course = 1;
        $id_module = 1;
        $gradeModel = model('GradeModel');
        $data = $gradeModel->getApprenticeModuleGrade($id_user_course,
            $id_module);
        $expect = [
            'fk_user_course' => "1",
            'fk_teaching_module' => "1",
            'date' => "2024-08-23",
            'grade' => "4.5",
            'is_school' => "1",
            'archive' => null,
            'official_name' => 'Interroger, traiter et assurer la maintenance'
                . ' des bases de données'
        ];
        $this->assertEquals($expect, $data);
    }

    /**
     * Tests the retrieval of apprentice subject average.
     *
     * @covers GradeModel::getApprenticeSubjectAverage
     */
    public function testGetApprenticeSubjectAverage(): void
    {
        $id_user_course = 1;
        $id_subject = 1;
        $gradeModel = model('GradeModel');
        $data = $gradeModel->getApprenticeSubjectAverage($id_user_course,
            $id_subject, fn($e) => $e);
        $expect = 4.25;
        $this->assertEquals($expect, $data);
    }

    /**
     * Tests that the average grade is correctly rounded to the nearest half
     * point.
     *
     * @covers GradeModel::getApprenticeSubjectAverage
     * @covers GradeModel::roundHalfPoint
     */
    public function testGetApprenticeSubjectAverageRoundHalfPoint(): void
    {
        $id_user_course = 1;
        $id_subject = 1;
        $gradeModel = model('GradeModel');
        $data = $gradeModel->getApprenticeSubjectAverage($id_user_course,
            $id_subject, [$gradeModel, 'roundHalfPoint']);
        $expect = 4.5;
        $this->assertEquals($expect, $data);
    }
    /**
     * Tests that the average grade is correctly rounded to one decimal point
     * by default.
     *
     * @covers GradeModel::getApprenticeSubjectAverage
     */
    public function testGetApprenticeSubjectAverageRoundOneDecimalPoint(): void
    {
        $id_user_course = 1;
        $id_subject = 1;
        $gradeModel = model('GradeModel');
        $data = $gradeModel->getApprenticeSubjectAverage($id_user_course,
            $id_subject);
        $expect = 4.3;
        $this->assertEquals($expect, $data);
    }

    /**
     * Tests the retrieval of apprentice module average for school grades.
     *
     * @covers GradeModel::getApprenticeModuleAverage
     */
    public function testGetApprenticeModuleAverageIsSchool(): void
    {
        $id_user_course = 1;
        $is_school = true;

        $gradeModel = model('GradeModel');
        $data = $gradeModel->getApprenticeModuleAverage($id_user_course,
            $is_school, fn($e) => $e);
        $expect = 4.75;
        $this->assertEquals($expect, $data);
    }

    /**
     * Tests that the getApprenticeModuleAverage method returns the correct
     * average
     * when the school rounding rule is half point.
     *
     * @covers GradeModel::getApprenticeModuleAverage
     * @covers GradeModel::roundHalfPoint
     */
    public function
        testGetApprenticeModuleAverageIsSchoolRoundHalfPoint(): void
    {
        $id_user_course = 1;
        $is_school = true;

        $gradeModel = model('GradeModel');
        $data = $gradeModel->getApprenticeModuleAverage($id_user_course,
            $is_school, [$gradeModel, 'roundHalfPoint']);
        $expect = 5;
        $this->assertEquals($expect, $data);
    }

    /**
     * Tests the retrieval of apprentice module average for non-school
     * (interentreprises) grades.
     *
     * @covers GradeModel::getApprenticeModuleAverage
     */
    public function testGetApprenticeModuleAverageIsNotSchool(): void
    {
        $id_user_course = 1;
        $is_school = false;

        $gradeModel = model('GradeModel');
        $data = $gradeModel->getApprenticeModuleAverage($id_user_course,
            $is_school);
        $expect = 3;
        $this->assertEquals($expect, $data);
    }

    /**
     * Test that deleting a grade removes it from the active records.
     */
    public function testDelete(): void
    {
        $id = 1;
        $gradeModel = model('GradeModel');
        $gradeModel->delete($id);
        $grade = $gradeModel->find($id);
        $deletedGrade = $gradeModel->withDeleted()->find($id);
        $this->assertNull($grade);
        $this->assertEquals($id, $deletedGrade['id']);
    }

    /**
     * Test that finding all grades with deleted records includes the deleted
     * records.
     */
    public function testFindAllWithDeleted(): void
    {
        $idToDelete = 1;
        $gradeModel = model('GradeModel');
        $gradeModel->delete($idToDelete);
        $domains = $gradeModel->withDeleted()->findAll();
        $this->assertEquals($domains[0]['id'], $idToDelete);
    }

    /**
     * Test that finding all grades with only deleted records returns only the
     * deleted records.
     */
    public function testFindAllOnlyDeleted(): void
    {
        $idToDelete = 1;
        $gradeModel = model('GradeModel');
        $gradeModel->delete($idToDelete);
        $domains = $gradeModel->onlyDeleted()->findAll();
        $this->assertEquals($domains[0]['id'], $idToDelete);
        $this->assertFalse(isset($domains[1]));
    }

    /**
     * Test that finding all grades without deleted records excludes the
     * deleted records.
     */
    public function testFindAllWithoutDeleted(): void
    {
        $idToDelete = 1;
        $gradeModel = model('GradeModel');
        $gradeModel->delete($idToDelete);
        $domains = $gradeModel->findAll();
        $this->assertNotEquals($domains[0]['id'], $idToDelete);
        $this->assertTrue(isset($domains[1]));
    }

    /**
     * Test that finding all grades is equivalent to finding without an ID.
     */
    public function testFindAllEqualsFindWithoutId(): void
    {
        $gradeModel = model('GradeModel');
        $domains = $gradeModel->findAll();
        $domains2 = $gradeModel->find();
        $this->assertEquals($domains, $domains2);
    }



    public function testGetWeightedModuleAverage(): void
    {
        $idUserCourse = 1;

        $gradeModel = model('GradeModel');
        $result = $gradeModel->getWeightedModuleAverage($idUserCourse);

        $expectedAverage = 4.4;
        $this->assertEquals($expectedAverage, $result);
    }

    public function testGetApprenticeDomainAverageNotModule(): void
    {
        $gradeModel = model('GradeModel');
        $result = $gradeModel->getApprenticeDomainAverageNotModule(1, 1);
        $this->assertEquals(4.25, $result);
    }


}
