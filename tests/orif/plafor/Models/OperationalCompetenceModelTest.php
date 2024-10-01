<?php
/**
 * Unit / Integration tests OperationalCompetenceModelTest
 *
 * @author      Orif (CaLa)
 * @link        https://github.com/OrifInformatique
 * @copyright   Copyright (c), Orif (https://www.orif.ch)
 */
namespace Plafor\Models;

use CodeIgniter\Test\CIUnitTestCase;

class OperationalCompetenceModelTest extends CIUnitTestCase
{
    /**
     * Asserts that getInstance method of OperationalCompetenceModel returns an instance of OperationalCompetenceModel
     */
    public function testgetOperationalCompetenceModelInstance()
    {
        $operationalCompetenceModel = model('OperationalCompetenceModel');
        $this->assertTrue($operationalCompetenceModel instanceof OperationalCompetenceModel);
        $this->assertInstanceOf(OperationalCompetenceModel::class, $operationalCompetenceModel);
    }

    /**
     * Checks that the getCompetenceDomain method of OperationalCompetenceModel returns the expected competence domain
     */
    public function testgetCompetenceDomain()
    {
        // Gets the competence domain with the course plan id 1
        $operationalCompetenceModel = model('OperationalCompetenceModel');
        $competence_domain = $operationalCompetenceModel->getCompetenceDomain(1);

        // Assertions
        $this->assertIsArray($competence_domain);
        $this->assertEquals($competence_domain['id'], 1);
        $this->assertEquals($competence_domain['fk_course_plan'], 1);
        $this->assertEquals($competence_domain['symbol'], 'A');
        $this->assertEquals($competence_domain['name'], 'Saisie, interprétation et mise en œuvre des exigences des applications');
        $this->assertEquals($competence_domain['archive'], NULL);
    }

    /**
     * Checks that the getObjectives method of OperationalCompetenceModel returns the expected objectives
     */
    public function testgetObjectives()
    {
        // Gets the objectives
        $operationalCompetenceModel = model('OperationalCompetenceModel');
        $objectives = $operationalCompetenceModel->getObjectives(1);

        // Assertions
        $this->assertIsArray($objectives);

        // For each objective, asserts that the operational competence id is 1
        foreach ($objectives as $objective) {
            $this->assertEquals($objective['fk_operational_competence'], 1);
        }
    }

    /**
     * Checks that the getOperationalCompetences method of OperationalCompetenceModel returns the expected operational competences
     */
    public function testgetOperationalCompetences()
    {
        // Gets the operational competence with the competence domain id 1
        $operationalCompetenceModel = model('OperationalCompetenceModel');
        $operationalCompetences = $operationalCompetenceModel->getOperationalCompetences(false, 1);

        // Assertions
        $this->assertIsArray($operationalCompetences);

        // For each operational competence, asserts that the competence domain id is 1
        foreach ($operationalCompetences as $operationalCompetence) {
            $this->assertEquals($operationalCompetence['fk_competence_domain'], 1);
        }
    }

    /**
     * Checks that the getOperationalCompetences method of OperationalCompetenceModel returns the expected operational competences
     */
    public function testgetOperationalCompetencesWithNoCompetenceDomainId()
    {
        // Gets the operational competence with the competence domain id 0
        $operationalCompetenceModel = model('OperationalCompetenceModel');
        $operationalCompetences = $operationalCompetenceModel->getOperationalCompetences(false, 0);

        // Assertions
        $this->assertIsArray($operationalCompetences);
    }
}
