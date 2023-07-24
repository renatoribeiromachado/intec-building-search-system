<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            ['description' => 'PRESIDENTE'],
            ['description' => 'DIRETOR DA ENGENHARIA'],
            ['description' => 'COMPRADOR / MATERIAIS'],
            ['description' => 'ADMINISTRADOR(A)'],
            ['description' => 'ANALISTA FINANCEIRO'],
            ['description' => 'ARQUITETO(A)'],
            ['description' => 'ASSESSOR'],
            ['description' => 'ASSISTENTE COMERCIAL'],
            ['description' => 'AUX. ADMINISTRATIVO'],
            ['description' => 'COMPRADOR GERAL'],
            ['description' => 'COMPRADOR / MATERIAIS'],
            ['description' => 'CONSTRUTOR'],
            ['description' => 'CONSULTOR(A)'],
            ['description' => 'CONTADOR(A)'],
            ['description' => 'CONTATO'],
            ['description' => 'COORDENADOR(A)'],
            ['description' => 'CORRETOR(A)'],
            ['description' => 'DEPARTAMENTO PESSOAL'],
            ['description' => 'DIR. ADMINISTRATIVO'],
            ['description' => 'DIRETOR DE COMPRAS'],
            ['description' => 'DIR. DE ENGENHARIA'],
            ['description' => 'DIR. DE LOGÍSTICA'],
            ['description' => 'DIR. DE OBRAS'],
            ['description' => 'DIR. FINANCEIRO'],
            ['description' => 'DIR. SÓCIO(A)'],
            ['description' => 'DIR. SUPERINTENDENTE'],
            ['description' => 'DIR. TÉCNICO'],
            ['description' => 'ENC. DEPTO PESSOAL'],
            ['description' => 'ENC. GERAL'],
            ['description' => 'ENG. AGRÔNOMO'],
            ['description' => 'ENG. DE CONTRATOS'],
            ['description' => 'ENG. DE PLANEJAMENTO'],
            ['description' => 'ENG. RESPONSÁVEL OBRA'],
            ['description' => 'ENGENHEIRO(A)'],
            ['description' => 'FISCAL'],
            ['description' => 'GER. ADMINISTRATIVO'],
            ['description' => 'GERENTE DE ENGENHARIA'],
            ['description' => 'GERENTE DE COMPRAS'],
            ['description' => 'GER. DE MARKETING'],
            ['description' => 'GER. DE OPERAÇÕES'],
            ['description' => 'GER. DE PLANEJAMENTO'],
            ['description' => 'GER. DE SISTEMAS'],
            ['description' => 'GER. DES. PROJETOS'],
            ['description' => 'GER. GERAL'],
            ['description' => 'GER. INDUSTRIAL'],
            ['description' => 'GER. PROJETISTA'],
            ['description' => 'GER. SUPRIMENTOS'],
            ['description' => 'GER. DEPTO PESSOAL'],
            ['description' => 'GERENTE DE NEGÓCIOS'],
            ['description' => 'GERENTE DE OBRAS'],
            ['description' => 'GERENTE REGIONAL'],
            ['description' => 'GESTÃO DE CUSTOS'],
            ['description' => 'MARKETING'],
            ['description' => 'MESTRE DE OBRAS'],
            ['description' => 'PAISAGISMO'],
            ['description' => 'PROPRIETÁRIO(A)'],
            ['description' => 'RECEPCIONISTA'],
            ['description' => 'RECURSOS HUMANOS'],
            ['description' => 'REITOR(A)'],
            ['description' => 'REPRES. COMERCIAL'],
            ['description' => 'RESP. DE IMPLANTAÇÃO'],
            ['description' => 'RESP. DE PROJETO'],
            ['description' => 'RESPONSÁVEL TÉCNICO'],
            ['description' => 'SECR. ADMINISTRATIVO(A)'],
            ['description' => 'SECR. DA  AGRICULTURA'],
            ['description' => 'SECR. DA JUSTIÇA'],
            ['description' => 'SECRETÁRIO(A)'],
            ['description' => 'SUPERINTENDENTE'],
            ['description' => 'SUPERV. ADMIN.'],
            ['description' => 'SUPERVISOR DE OBRAS'],
            ['description' => 'SUPERVISOR DE VENDAS'],
            ['description' => 'SUPRIMENTOS'],
            ['description' => 'TELEFONISTA'],
            ['description' => 'USUÁRIO'],
            ['description' => 'ASSINANTE'],
            ['description' => 'DEPTO. MARKETING'],
            ['description' => 'VENDEDOR (A)'],
            ['description' => 'DIRETOR (A) '],
            ['description' => 'ENGENHEIRO(A)'],
            ['description' => 'FINANCEIRO'],
            ['description' => 'ASSINANTE / USUÁRIO'],
            ['description' => 'ANALISTA DE MARKETING'],
            ['description' => 'ASSISTENTE TÉCNICO'],
            ['description' => 'ASSISTENTE DA DIRETORIA'],
            ['description' => 'ADMINISTRADOR (A) FINANCEIRO (A)'],
            ['description' => 'ADMINISTRADOR (A) COMERCIAL'],
            ['description' => 'COORD. FINANCEIRO (A)'],
            ['description' => 'CONSULTORIA COMERCIAL'],
            ['description' => 'DEPTO. COMERCIAL'],
            ['description' => 'DEPTO. DE ESPECIFICAÇÃO'],
            ['description' => 'DEPTO. T.I.'],
            ['description' => 'DEPTO. RH'],
            ['description' => 'DEPTO DE COMUNICAÇÃO'],
            ['description' => 'ESTAGIÁRIO (A)'],
            ['description' => 'ESTAGIÁRIO (A) DE PROSPECÇÃO'],
            ['description' => 'ENG. DE PROJETO'],
            ['description' => 'ORÇAMENTISTA'],
            ['description' => 'PESQUISADOR (A)'],
            ['description' => 'PÓS VENDAS'],
            ['description' => 'ANALISTA DE MERCADO'],
            ['description' => 'PROJETOS'],
            ['description' => 'ADMINISTRATIVO DE OBRAS'],
            ['description' => 'GERENTE DE PROJETOS E AQUISIÇÃO'],
            ['description' => 'MANUTENÇÃO E INFRAESTRUTURA'],
            ['description' => 'DIRETORIA DE INVESTIMENTOS'],
            ['description' => 'COORDENADOR(A) DE ENGENHARIA'],
            ['description' => 'ANALISTA DE SUPRIMENTOS'],
            ['description' => 'COORDENADOR DE COMPRAS'],
            ['description' => 'COORDENADORA ADMINISTRATIVA'],
            ['description' => 'TESTEMUNHA'],
            ['description' => 'CONTRATADA'],
            ['description' => 'CONTRATANTE'],
            ['description' => 'COORDENADOR DE OBRAS'],
            ['description' => 'COMPRADOR(A) DE MATÉRIA PRIMA'],
            ['description' => 'AUX. DE COMPRAS'],
        ];

        $positionsQuantity = count($positions);
        Position::factory($positionsQuantity)
            ->make()
            ->each(function ($position, $key) use ($positions) {
                $positionDescription = $positions[$key]['description'];
                $position->description = $positionDescription;
                $position->save();
            });
    }
}
