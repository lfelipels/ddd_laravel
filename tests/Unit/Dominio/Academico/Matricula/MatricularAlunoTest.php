<?php

namespace Tests\Unit\Dominio\Academico\Matricula;

use Tests\TestCase;
use Ddd\Arquitetura\Dominios\Shared\Cpf;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ddd\Arquitetura\Dominios\Academico\Curso\Curso;
use Ddd\Arquitetura\Dominios\Academico\Matricula\MatricularAluno;
use Ddd\Arquitetura\Dominios\Academico\Matricula\MatriculaDeAlunoDto;
use Ddd\Arquitetura\Dominios\Academico\Aluno\RepositorioDeAlunoComEloquent;
use Ddd\Arquitetura\Dominios\Academico\Curso\RepositorioDeCursoComEloquent;
use Ddd\Arquitetura\Dominios\Academico\Matricula\RepositorioDeMatriculaComEloquent;

class MatricularAlunoTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $repositorioDeAluno;
    private $repositorioDeCurso;
    private $repositorioDeMatricula;

    public function setUp(): void
    {
        parent::setUp();
        $this->repositorioDeAluno = new RepositorioDeAlunoComEloquent;
        $this->repositorioDeCurso = new RepositorioDeCursoComEloquent;
        $this->repositorioDeMatricula = new RepositorioDeMatriculaComEloquent();
    }

    public function testMatricularAlunoSemCadastro()
    {
        $curso = factory(Curso::class)->create();
        $dadosMatricula = new MatriculaDeAlunoDto(
            'Luis Felipe',
            '123.456.789-10',
            $curso->id
        );

        $matriculador = new MatricularAluno($this->repositorioDeAluno, $this->repositorioDeCurso);
        $matriculador->executar($dadosMatricula);
        $aluno = $this->repositorioDeAluno->localizarPorCpf(new Cpf('123.456.789-10'));
        $matriculas = $this->repositorioDeMatricula->recuperarMatriculasPorAluno($aluno);

        $this->assertEquals($dadosMatricula->nome(), $aluno->nome);
        $this->assertEquals($dadosMatricula->cpf(), $aluno->cpf);
        $this->assertCount(1, $matriculas);
        $this->assertIsNumeric($matriculas->first()->numero);
        $this->assertEquals($matriculas->first()->aluno->id, $aluno->id);
        $this->assertEquals($matriculas->first()->curso->id, $curso->id);
    }

    public function testAlunoNaoPodeSerMatriculadoNoMesmoCursoMaisDeUmaVez()
    {
        $this->expectException(\DomainException::class);
        $curso = factory(Curso::class)->create();
        $dadosMatricula = new MatriculaDeAlunoDto(
            'Luis Felipe',
            '123.456.789-10',
            $curso->id
        );

        $matriculador = new MatricularAluno($this->repositorioDeAluno, $this->repositorioDeCurso);
        $matriculador->executar($dadosMatricula);
        $matriculador->executar($dadosMatricula);
    }
}
