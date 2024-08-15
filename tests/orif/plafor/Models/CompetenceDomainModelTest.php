<?php
/**
 * Unit / Integration tests CompetenceDomainModelTest 
 *
 * @author      Orif (CaLa)
 * @link        https://github.com/OrifInformatique
 * @copyright   Copyright (c), Orif (https://www.orif.ch)
 */
namespace Plafor\Models;

use CodeIgniter\Test\CIUnitTestCase;

class CompetenceDomainModelTest extends CIUnitTestCase
{
    /**
     * Asserts that getInstance method of CompetenceDomainModel returns an
     * instance of CompetenceDomainModel
     */
    public function testgetCompetenceDomainModelInstance()
    {
        $competenceDomainModel = model('CompetenceDomainModel');
        $this->assertTrue($competenceDomainModel instanceof CompetenceDomainModel);
        $this->assertInstanceOf(CompetenceDomainModel::class, $competenceDomainModel);
    }

    /**
     * Checks that the getCoursePlan method of CompetenceDomainModel returns
     * the expected course plan
     */
    public function testgetCoursePlan()
    {
        // Gets the course plan with the id 1
        $competenceDomainModel = model('CompetenceDomainModel');
        $coursePlan = $competenceDomainModel->getCoursePlan(6);

        // Assertions
        $this->assertIsArray($coursePlan);
        $this->assertEquals($coursePlan['id'], 6);
        $this->assertEquals($coursePlan['formation_number'], 88611);
        $this->assertEquals($coursePlan['official_name'], 'Informaticienne / Informaticien avec CFC, orientation développement d\'applications');
        $this->assertEquals($coursePlan['date_begin'], '2021-08-01');
        $this->assertEquals($coursePlan['archive'], NULL);
    }

    /**
     * Checks that the getOperationalCompetences method of CompetenceDomainModel returns the expected operational competences
     */
    public function testgetOperationalCompetences()
    {
        // Gets the operational competences with the competence domain id 1
        $competenceDomainModel = model('CompetenceDomainModel');
        $operationalCompetences = $competenceDomainModel->getOperationalCompetences(1);

        // Assertions
        $this->assertIsArray($operationalCompetences);

        // For each operational competences, asserts that the competence domain is 1
        foreach ($operationalCompetences as $operationalCompetence) {
            $this->assertEquals($operationalCompetence['fk_competence_domain'], 1);
        }
    }

    /**
     * Checks that the getCompetenceDomains method of CompetenceDomainModel returns the expected competence domains
     */
    public function testgetCompetenceDomains()
    {
        // Gets the competence domains with the course plan id 1
        $competenceDomainModel = model('CompetenceDomainModel');
        $competenceDomains = $competenceDomainModel->getCompetenceDomains(false, 1);

        // Assertions
        $this->assertIsArray($competenceDomains);

        // For each competence domain, asserts that the course plan id is 1
        foreach ($competenceDomains as $competenceDomain) {
            $this->assertEquals($competenceDomain['fk_course_plan'], 1);
        }
    }

    /**
     * Checks that the getCompetenceDomains method of CompetenceDomainModel returns the expected competence domains
     */
    public function testgetCompetenceDomainsWithNoCoursePlanId()
    {
        // Gets the competence domains with the course plan id 1
        $competenceDomainModel = model('CompetenceDomainModel');
        $competenceDomains = $competenceDomainModel->getCompetenceDomains(false);

        // Assertions
        $this->assertIsArray($competenceDomains);
    }
}
