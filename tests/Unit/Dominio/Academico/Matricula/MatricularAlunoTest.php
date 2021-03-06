<?php

namespace Tests\Unit\Dominio\Academico\Matricula;

use Ddd\Arquitetura\Aplicacoes\Shared\Emails\EmailAlunoMatriculado;
use Ddd\Arquitetura\Dominios\Academico\Aluno\AlunoMatriculado;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Ddd\Arquitetura\Dominios\Shared\Cpf;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ddd\Arquitetura\Dominios\Academico\Curso\Curso;
use Ddd\Arquitetura\Suporte\Evento\DisparadorDeEventoLaravel;
use Ddd\Arquitetura\Dominios\Academico\Matricula\MatricularAluno;
use Ddd\Arquitetura\Dominios\Academico\Matricula\NumeroDeMatricula;
use Ddd\Arquitetura\Dominios\Academico\Matricula\MatriculaDeAlunoDto;
use Ddd\Arquitetura\Dominios\Academico\Aluno\RepositorioDeAlunoComEloquent;
use Ddd\Arquitetura\Dominios\Academico\Curso\RepositorioDeCursoComEloquent;
use Ddd\Arquitetura\Dominios\Academico\Matricula\RepositorioDeMatriculaComEloquent;
use Illuminate\Support\Facades\Mail;

class MatricularAlunoTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $repositorioDeAluno;
    private $repositorioDeCurso;
    private $repositorioDeMatricula;
    private $servicoDeMatricula;
    private $curso;

    public function setUp(): void
    {
        parent::setUp();
        $this->repositorioDeAluno = new RepositorioDeAlunoComEloquent;
        $this->repositorioDeCurso = new RepositorioDeCursoComEloquent;
        $this->repositorioDeMatricula = new RepositorioDeMatriculaComEloquent();
        $this->servicoDeMatricula = new MatricularAluno(
            $this->repositorioDeAluno,
            $this->repositorioDeCurso,
            new DisparadorDeEventoLaravel()
        );
        $this->curso = factory(Curso::class)->create();
    }

    public function testMatricularAlunoSemCadastro()
    {
        $this->matricularAluno();
        $aluno = $this->repositorioDeAluno->localizarPorCpf(new Cpf('123.456.789-10'));
        $matriculas = $this->repositorioDeMatricula->recuperarMatriculasPorAluno($aluno);

        $this->assertCount(1, $matriculas);
        $this->assertInstanceOf(NumeroDeMatricula::class, $matriculas->first()->numero);
        $this->assertNotEmpty($matriculas->first()->numero);
        $this->assertEquals($aluno->id, $matriculas->first()->aluno->id);
        $this->assertEquals($this->curso->id, $matriculas->first()->curso->id);
    }

    public function testEnviarEmailDeMatricula()
    {
        Mail::fake();
        $this->matricularAluno();
        Mail::assertSent(EmailAlunoMatriculado::class);
    }

    public function testAlunoNaoPodeSerMatriculadoNoMesmoCursoMaisDeUmaVez()
    {
        $this->expectException(\DomainException::class);
        $this->matricularAluno();
        $this->matricularAluno();
    }


    private function matricularAluno()
    {
        // $curso = factory(Curso::class)->create();
        $dadosMatricula = new MatriculaDeAlunoDto(
            'Aluno de Exemplo',
            '123.456.789-10',
            'email@exemplo.com',
            $this->curso->id
        );
        $this->servicoDeMatricula->executar($dadosMatricula);
    }
}
