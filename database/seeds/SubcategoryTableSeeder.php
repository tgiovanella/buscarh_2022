<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubcategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('subcategories')->insert([
            //outplaces
            [
                'name' => 'pós demissão',
                'slug' => Str::slug('pós demissão'),
                'category_id' => 1
            ],
            [

                'name' => 'pré aposentadoria',
                'slug' => Str::slug('pré aposentadoria'),
                'category_id' => 1
            ],
            [

                'name' => 'indicações gratuitas',
                'slug' => Str::slug('indicações gratuitas'),
                'category_id' => 1
            ],
            [

                'name' => 'transição de carreira',
                'slug' => Str::slug('transição de carreira'),
                'category_id' => 1
            ],
            [

                'name' => 'pessoa física / jurídica',
                'slug' => Str::slug('pessoa física / jurídica'),
                'category_id' => 1
            ],
            [
                'name' => 'em grupo',
                'slug' => Str::slug('em grupo'),
                'category_id' => 1


                //recurtamento
            ], [

                'name' => trim('mão de obra temporária '),
                'slug' => Str::slug(trim('mão de obra temporária ')),
                'category_id' => 2
            ], [
                'name' => trim('Onboarding '),
                'slug' => Str::slug(trim('Onboarding ')),
                'category_id' => 2
            ], [
                'name' => trim('Administrativo / Técnico / Operacional'),
                'slug' => Str::slug(trim('Administrativo / Técnico / Operacional')),
                'category_id' => 2
            ], [
                'name' => trim('média / alta gerência '),
                'slug' => Str::slug(trim('média / alta gerência ')),
                'category_id' => 2
            ], [
                'name' => trim('C level '),
                'slug' => Str::slug(trim('C level ')),
                'category_id' => 2
            ], [
                'name' => trim('PCDs'),
                'slug' => Str::slug(trim('PCDs')),
                'category_id' => 2
            ], [
                'name' => trim('Terceirização / Interin Management '),
                'slug' => Str::slug(trim('Terceirização / Interin Management ')),
                'category_id' => 2
            ], [
                'name' => trim('mapeamento de profissionais / mercado'),
                'slug' => Str::slug(trim('mapeamento de profissionais / mercado')),
                'category_id' => 2
            ], [
                'name' => trim('hunting / Headhunter '),
                'slug' => Str::slug(trim('hunting / Headhunter ')),
                'category_id' => 2
            ], [
                'name' => trim('testes / assessments '),
                'slug' => Str::slug(trim('testes / assessments ')),
                'category_id' => 2
            ], [
                'name' => trim('Análise preditiva '),
                'slug' => Str::slug(trim('Análise preditiva ')),
                'category_id' => 2
            ], [
                'name' => trim('Entrevista digital '),
                'slug' => Str::slug(trim('Entrevista digital ')),
                'category_id' => 2
            ], [
                'name' => trim('vídeo currículo '),
                'slug' => Str::slug(trim('vídeo currículo ')),
                'category_id' => 2
            ], [
                'name' => trim('Recrutamento digital'),
                'slug' => Str::slug(trim('Recrutamento digital')),
                'category_id' => 2
            ], [
                'name' => trim('RPO (recruiting process outsource)'),
                'slug' => Str::slug(trim('RPO (recruiting process outsource)')),
                'category_id' => 2
            ], [
                'name' => trim('ATS (applicant tracking system) / Sistema Informatizado'),
                'slug' => Str::slug(trim('ATS (applicant tracking system) / Sistema Informatizado')),
                'category_id' => 2
            ], [
                'name' => trim('Job Posting'),
                'slug' => Str::slug(trim('Job Posting')),
                'category_id' => 2
            ], [
                'name' => trim('Engenharia '),
                'slug' => Str::slug(trim('Engenharia ')),
                'category_id' => 2
            ], [
                'name' => trim('Finanças'),
                'slug' => Str::slug(trim('Finanças')),
                'category_id' => 2
            ], [
                'name' => trim('RH'),
                'slug' => Str::slug(trim('RH')),
                'category_id' => 2
            ], [
                'name' => trim('Supply Chain'),
                'slug' => Str::slug(trim('Supply Chain')),
                'category_id' => 2
            ], [
                'name' => trim('Vendas / Comercial'),
                'slug' => Str::slug(trim('Vendas / Comercial')),
                'category_id' => 2
            ], [
                'name' => trim('Marketing '),
                'slug' => Str::slug(trim('Marketing ')),
                'category_id' => 2
            ], [
                'name' => trim('Operações '),
                'slug' => Str::slug(trim('Operações ')),
                'category_id' => 2
            ], [
                'name' => trim('Jurídico / Legal'),
                'slug' => Str::slug(trim('Jurídico / Legal')),
                'category_id' => 2
            ], [
                'name' => trim('Seguros'),
                'slug' => Str::slug(trim('Seguros')),
                'category_id' => 2
            ], [
                'name' => trim('Automotivo'),
                'slug' => Str::slug(trim('Automotivo')),
                'category_id' => 2
            ], [
                'name' => trim('Óleo e Gás'),
                'slug' => Str::slug(trim('Óleo e Gás')),
                'category_id' => 2
            ], [
                'name' => trim('Energia'),
                'slug' => Str::slug(trim('Energia')),
                'category_id' => 2
            ], [
                'name' => trim('Construção'),
                'slug' => Str::slug(trim('Construção')),
                'category_id' => 2
            ], [
                'name' => trim('Manufatura'),
                'slug' => Str::slug(trim('Manufatura')),
                'category_id' => 2
            ], [
                'name' => trim('Mineração e Metais'),
                'slug' => Str::slug(trim('Mineração e Metais')),
                'category_id' => 2
            ], [
                'name' => trim('IT e Telecom'),
                'slug' => Str::slug(trim('IT e Telecom')),
                'category_id' => 2
            ], [
                'name' => trim('Corporate'),
                'slug' => Str::slug(trim('Corporate')),
                'category_id' => 2
            ], [
                'name' => trim('Agronegócios'),
                'slug' => Str::slug(trim('Agronegócios')),
                'category_id' => 2
            ], [
                'name' => trim('Tecnologia'),
                'slug' => Str::slug(trim('Tecnologia')),
                'category_id' => 2
            ], [
                'name' => trim('Varejo '),
                'slug' => Str::slug(trim('Varejo ')),
                'category_id' => 2
            ], [
                'name' => trim('Bancos'),
                'slug' => Str::slug(trim('Bancos')),
                'category_id' => 2
            ], [
                'name' => trim('Bens de Consumo'),
                'slug' => Str::slug(trim('Bens de Consumo')),
                'category_id' => 2
            ], [
                'name' => trim('Saúde'),
                'slug' => Str::slug(trim('Saúde')),
                'category_id' => 2
            ], [
                'name' => trim('Ciências da Vida'),
                'slug' => Str::slug(trim('Ciências da Vida')),
                'category_id' => 2
            ], [
                'name' => trim('Start ups'),
                'slug' => Str::slug(trim('Start ups')),
                'category_id' => 2
            ]

            //coaching
            , [
                'name' => trim('certificação '),
                'slug' => Str::slug(trim('certificação ')),
                'category_id' => 3
            ], [
                'name' => trim('executivo / profissional'),
                'slug' => Str::slug(trim('executivo / profissional')),
                'category_id' => 3
            ], [
                'name' => trim('Coaching de Equipe'),
                'slug' => Str::slug(trim('Coaching de Equipe')),
                'category_id' => 3
            ], [
                'name' => trim('liderança '),
                'slug' => Str::slug(trim('liderança ')),
                'category_id' => 3
            ], [
                'name' => trim('negócios '),
                'slug' => Str::slug(trim('negócios ')),
                'category_id' => 3
            ], [
                'name' => trim('carreira'),
                'slug' => Str::slug(trim('carreira')),
                'category_id' => 3
            ], [
                'name' => trim('pré aposentadoria '),
                'slug' => Str::slug(trim('pré aposentadoria ')),
                'category_id' => 3
            ], [
                'name' => trim('Life Coaching'),
                'slug' => Str::slug(trim('Life Coaching')),
                'category_id' => 3
            ], [
                'name' => trim('sucessão '),
                'slug' => Str::slug(trim('sucessão ')),
                'category_id' => 3
            ], [

                //treinamentos
                'name' => trim('produtividade sustentável '),
                'slug' => Str::slug(trim('produtividade sustentável ')),
                'category_id' => 4,
            ], [
                'name' => trim('Legislação / Regulamentos'),
                'slug' => Str::slug(trim('Legislação / Regulamentos')),
                'category_id' => 4,
            ], [
                'name' => trim('Inteligência Emocional '),
                'slug' => Str::slug(trim('Inteligência Emocional ')),
                'category_id' => 4,
            ], [
                'name' => trim('e- social '),
                'slug' => Str::slug(trim('e- social ')),
                'category_id' => 4,
            ], [
                'name' => trim('Indicadores / métricas '),
                'slug' => Str::slug(trim('Indicadores / métricas ')),
                'category_id' => 4,
            ], [
                'name' => trim('Comunicação / Oratória / Relacionamento'),
                'slug' => Str::slug(trim('Comunicação / Oratória / Relacionamento')),
                'category_id' => 4,
            ], [
                'name' => trim('Motivação'),
                'slug' => Str::slug(trim('Motivação')),
                'category_id' => 4,
            ], [
                'name' => trim('Empreendedorismo'),
                'slug' => Str::slug(trim('Empreendedorismo')),
                'category_id' => 4,
            ], [
                'name' => trim('Estratégia '),
                'slug' => Str::slug(trim('Estratégia ')),
                'category_id' => 4,
            ], [
                'name' => trim('Gestão do Tempo / Conflitos / Pessoas / Feedback'),
                'slug' => Str::slug(trim('Gestão do Tempo / Conflitos / Pessoas / Feedback')),
                'category_id' => 4,
            ], [
                'name' => trim('Gestão de Projetos / PMI / PMO'),
                'slug' => Str::slug(trim('Gestão de Projetos / PMI / PMO')),
                'category_id' => 4,
            ], [
                'name' => trim('Gestão Pública'),
                'slug' => Str::slug(trim('Gestão Pública')),
                'category_id' => 4,
            ], [
                'name' => trim('Segurança / NR / EPIs / FAP'),
                'slug' => Str::slug(trim('Segurança / NR / EPIs / FAP')),
                'category_id' => 4,
            ], [
                'name' => trim('Meio Ambiente / Educação Ambiental'),
                'slug' => Str::slug(trim('Meio Ambiente / Educação Ambiental')),
                'category_id' => 4,
            ], [
                'name' => trim('Saúde '),
                'slug' => Str::slug(trim('Saúde ')),
                'category_id' => 4,
            ], [
                'name' => trim('Remuneração '),
                'slug' => Str::slug(trim('Remuneração ')),
                'category_id' => 4,
            ], [
                'name' => trim('Benefícios '),
                'slug' => Str::slug(trim('Benefícios ')),
                'category_id' => 4,
            ], [
                'name' => trim('Qualidade'),
                'slug' => Str::slug(trim('Qualidade')),
                'category_id' => 4,
            ], [
                'name' => trim('5 S / Organização / House Keeping'),
                'slug' => Str::slug(trim('5 S / Organização / House Keeping')),
                'category_id' => 4,
            ], [
                'name' => trim('Lean / TPS'),
                'slug' => Str::slug(trim('Lean / TPS')),
                'category_id' => 4,
            ], [
                'name' => trim('6 Sigma'),
                'slug' => Str::slug(trim('6 Sigma')),
                'category_id' => 4,
            ], [
                'name' => trim('Norma ISO 9001 / 14001 / 50000 / IATF'),
                'slug' => Str::slug(trim('Norma ISO 9001 / 14001 / 50000 / IATF')),
                'category_id' => 4,
            ], [
                'name' => trim('OHSAS 18001 / SA 8000'),
                'slug' => Str::slug(trim('OHSAS 18001 / SA 8000')),
                'category_id' => 4,
            ], [
                'name' => trim('Vendas / Comercial / Marketing'),
                'slug' => Str::slug(trim('Vendas / Comercial / Marketing')),
                'category_id' => 4,
            ], [
                'name' => trim('Jurídico'),
                'slug' => Str::slug(trim('Jurídico')),
                'category_id' => 4,
            ], [
                'name' => trim('Recursos Humanos'),
                'slug' => Str::slug(trim('Recursos Humanos')),
                'category_id' => 4,
            ], [
                'name' => trim('Comércio Exterior / Importação / Exportação'),
                'slug' => Str::slug(trim('Comércio Exterior / Importação / Exportação')),
                'category_id' => 4,
            ], [
                'name' => trim('Compras / Negociação'),
                'slug' => Str::slug(trim('Compras / Negociação')),
                'category_id' => 4,
            ], [
                'name' => trim('Logística / PCP / MMOG'),
                'slug' => Str::slug(trim('Logística / PCP / MMOG')),
                'category_id' => 4,
            ], [
                'name' => trim('Finanças / Custos / Contabilidade / Fiscal / Tributário'),
                'slug' => Str::slug(trim('Finanças / Custos / Contabilidade / Fiscal / Tributário')),
                'category_id' => 4,
            ], [
                'name' => trim('TI'),
                'slug' => Str::slug(trim('TI')),
                'category_id' => 4,
            ], [
                'name' => trim('Excelência Operacional / Produção'),
                'slug' => Str::slug(trim('Excelência Operacional / Produção')),
                'category_id' => 4,
            ], [
                'name' => trim('Mnautenção'),
                'slug' => Str::slug(trim('Mnautenção')),
                'category_id' => 4,
            ], [
                'name' => trim('Formação de Multiplicadores Internos'),
                'slug' => Str::slug(trim('Formação de Multiplicadores Internos')),
                'category_id' => 4,
            ], [
                'name' => trim('Setup / SMED'),
                'slug' => Str::slug(trim('Setup / SMED')),
                'category_id' => 4,
            ], [
                'name' => trim('Coaching / PNL'),
                'slug' => Str::slug(trim('Coaching / PNL')),
                'category_id' => 4,
            ], [
                'name' => trim('Mentoring'),
                'slug' => Str::slug(trim('Mentoring')),
                'category_id' => 4,
            ], [
                'name' => trim('Counseling'),
                'slug' => Str::slug(trim('Counseling')),
                'category_id' => 4,
            ], [
                'name' => trim('Liderança / Desenvolvimento Gerencial'),
                'slug' => Str::slug(trim('Liderança / Desenvolvimento Gerencial')),
                'category_id' => 4,
            ], [
                'name' => trim('Trabalho em Equipe / Equipes auto gerenciadas'),
                'slug' => Str::slug(trim('Trabalho em Equipe / Equipes auto gerenciadas')),
                'category_id' => 4,
            ], [
                'name' => trim('Gestão de Risco / Compliance / Loss Prevention'),
                'slug' => Str::slug(trim('Gestão de Risco / Compliance / Loss Prevention')),
                'category_id' => 4,
            ], [
                'name' => trim('Idiomas'),
                'slug' => Str::slug(trim('Idiomas')),
                'category_id' => 4,
            ], [
                'name' => trim('e-learning / EAD'),
                'slug' => Str::slug(trim('e-learning / EAD')),
                'category_id' => 4,
            ], [
                'name' => trim('micro learning '),
                'slug' => Str::slug(trim('micro learning ')),
                'category_id' => 4,
            ], [
                'name' => trim('Vídeo treinamento '),
                'slug' => Str::slug(trim('Vídeo treinamento ')),
                'category_id' => 4,
            ], [
                'name' => trim('treinamento outdoor'),
                'slug' => Str::slug(trim('treinamento outdoor')),
                'category_id' => 4,
            ], [
                'name' => trim('treinamento in company '),
                'slug' => Str::slug(trim('treinamento in company ')),
                'category_id' => 4,
            ], [
                'name' => trim('educação continuada '),
                'slug' => Str::slug(trim('educação continuada ')),
                'category_id' => 4,
            ], [
                'name' => trim('Universidade Corporativa'),
                'slug' => Str::slug(trim('Universidade Corporativa')),
                'category_id' => 4,
            ], [
                'name' => trim('realidade aumentada '),
                'slug' => Str::slug(trim('realidade aumentada ')),
                'category_id' => 4,
            ], [
                'name' => trim('realidade virtual '),
                'slug' => Str::slug(trim('realidade virtual ')),
                'category_id' => 4,
            ], [
                'name' => trim('3 D'),
                'slug' => Str::slug(trim('3 D')),
                'category_id' => 4,
            ], [
                'name' => trim('Story telling '),
                'slug' => Str::slug(trim('Story telling ')),
                'category_id' => 4,
            ], [
                'name' => trim('mobile training '),
                'slug' => Str::slug(trim('mobile training ')),
                'category_id' => 4,
            ], [

                //BPO
                'name' => trim('BPO (Business Process Outsourcing) / Terceirização RH'),
                'slug' => Str::slug(trim('BPO (Business Process Outsourcing) / Terceirização RH')),
                'category_id' => 5,
            ], [
                'name' => trim('Guarda de Arquivos / e-filing'),
                'slug' => Str::slug(trim('Guarda de Arquivos / e-filing')),
                'category_id' => 5,
            ], [
                'name' => trim('Assessoria / Consultoria RH'),
                'slug' => Str::slug(trim('Assessoria / Consultoria RH')),
                'category_id' => 5,
            ], [

            //Remuneração 
                'name' => trim('sistema por pontos'),
                'slug' => Str::slug(trim('sistema por pontos')),
                'category_id' => 6,
            ], [
                'name' => trim('escalonamento'),
                'slug' => Str::slug(trim('escalonamento')),
                'category_id' => 6,
            ], [
                'name' => trim('Comparação'),
                'slug' => Str::slug(trim('Comparação')),
                'category_id' => 6,
            ], [
                'name' => trim('Towers Watson'),
                'slug' => Str::slug(trim('Towers Watson')),
                'category_id' => 6,
            ], [
                'name' => trim('Hay'),
                'slug' => Str::slug(trim('Hay')),
                'category_id' => 6,
            ], [
                'name' => trim('Gestão de Cargos e Salários'),
                'slug' => Str::slug(trim('Gestão de Cargos e Salários')),
                'category_id' => 6,
            ], [
                'name' => trim('Descrição de Cargos'),
                'slug' => Str::slug(trim('Descrição de Cargos')),
                'category_id' => 6,
            ], [
                'name' => trim('Sistema'),
                'slug' => Str::slug(trim('Sistema')),
                'category_id' => 6,
            ], [
                'name' => trim('expatriação '),
                'slug' => Str::slug(trim('expatriação ')),
                'category_id' => 6,
            ], [
                'name' => trim('Pesquisa / diagnóstico salarial e benefícios'),
                'slug' => Str::slug(trim('Pesquisa / diagnóstico salarial e benefícios')),
                'category_id' => 6,
            ] , [


            //beneficios
                'name' => trim('gestão de benefícios '),
                'slug' => Str::slug(trim('gestão de benefícios ')),
                'category_id' => 6,
            ],[
                'name' => trim('gestão de sinistralidade '),
                'slug' => Str::slug(trim('gestão de sinistralidade ')),
                'category_id' => 6,
            ],[
                'name' => trim('Sistema Informatizado'),
                'slug' => Str::slug(trim('Sistema Informatizado')),
                'category_id' => 6,
            ],[
                'name' => trim('Seguro Saúde / Vida'),
                'slug' => Str::slug(trim('Seguro Saúde / Vida')),
                'category_id' => 6,
            ],[
                'name' => trim('alimentação '),
                'slug' => Str::slug(trim('alimentação ')),
                'category_id' => 6,
            ],[
                'name' => trim('transporte '),
                'slug' => Str::slug(trim('transporte ')),
                'category_id' => 6,
            ],[
                'name' => trim('vale / ticket'),
                'slug' => Str::slug(trim('vale / ticket')),
                'category_id' => 6,
            ],[
                'name' => trim('leasing veículos '),
                'slug' => Str::slug(trim('leasing veículos ')),
                'category_id' => 6,
            ],[

            //

                'name' => 'Pesquisa de Clima Organizacional',
                'slug' => Str::slug('Pesquisa de Clima Organizacional'),
                'category_id' => 8
            ],[
                'name' => 'software ',
                'slug' => Str::slug('software '),
                'category_id' => 8
            ],[
                'name' => 'Reconhecimento  / Recompensa / Incentivos',
                'slug' => Str::slug('Reconhecimento  / Recompensa / Incentivos'),
                'category_id' => 8
            ],[
                'name' => 'cultura',
                'slug' => Str::slug('cultura'),
                'category_id' => 8
            ],[
                'name' => 'Diversidade e Inclusão (D&I)',
                'slug' => Str::slug('Diversidade e Inclusão (D&I)'),
                'category_id' => 8
            ],[

                //folha de pgamento
                'name' => trim('ASP (application solution provider)'),
                'slug' => Str::slug(trim('ASP (application solution provider)')),
                'category_id' => 9
            ],[

                'name' => trim('BSP (business solution provider)'),
                'slug' => Str::slug(trim('BSP (business solution provider)')),
                'category_id' => 9
            ],[

                'name' => trim('BPO (Business Process Outsourcing) / Terceirização'),
                'slug' => Str::slug(trim('BPO (Business Process Outsourcing) / Terceirização')),
                'category_id' => 9
            ],[

                'name' => trim('e-social '),
                'slug' => Str::slug(trim('e-social ')),
                'category_id' => 9
            ],[

                'name' => trim('Sistema'),
                'slug' => Str::slug(trim('Sistema')),
                'category_id' => 9
            ],[

                'name' => trim('Recuperação tributária '),
                'slug' => Str::slug(trim('Recuperação tributária ')),
                'category_id' => 9
            ],[

            //ponto eletronico
                'name' => trim('Relógio'),
                'slug' => Str::slug(trim('Relógio')),
                'category_id' => 9

            ],[
                'name' => trim('Catraca'),
                'slug' => Str::slug(trim('Catraca')),
                'category_id' => 9

            ],[
                'name' => trim('Sistema'),
                'slug' => Str::slug(trim('Sistema')),
                'category_id' => 9
            ],[

            //relações trabalhistas
                'name' => trim('Paralegal'),
                'slug' => Str::slug(trim('Paralegal')),
                'category_id' => 11
            ],[
                'name' => trim('Auditoria Trabalhista'),
                'slug' => Str::slug(trim('Auditoria Trabalhista')),
                'category_id' => 11
            ],[
                'name' => trim('Contencioso Trabalhista'),
                'slug' => Str::slug(trim('Contencioso Trabalhista')),
                'category_id' => 11
            ],[
                'name' => trim('Escritórios '),
                'slug' => Str::slug(trim('Escritórios ')),
                'category_id' => 11
            ],[

            //gestão de talentos
                'name' => trim('Programa Trainee'),
                'slug' => Str::slug(trim('Programa Trainee')),
                'category_id' => 12,
            ],[
                'name' => trim('Programa Estágio / Gestão de Estágios'),
                'slug' => Str::slug(trim('Programa Estágio / Gestão de Estágios')),
                'category_id' => 12,
            ],[
                'name' => trim('Avaliação de Desempenho / Competências'),
                'slug' => Str::slug(trim('Avaliação de Desempenho / Competências')),
                'category_id' => 12,
            ],[
                'name' => trim('Mapeamento de Competências'),
                'slug' => Str::slug(trim('Mapeamento de Competências')),
                'category_id' => 12,
            ],[
                'name' => trim('Assessment de potencial'),
                'slug' => Str::slug(trim('Assessment de potencial')),
                'category_id' => 12,
            ],[
                'name' => trim('DISC'),
                'slug' => Str::slug(trim('DISC')),
                'category_id' => 12,
            ],[
                'name' => trim('Quantum'),
                'slug' => Str::slug(trim('Quantum')),
                'category_id' => 12,
            ],[
                'name' => trim('MBTI'),
                'slug' => Str::slug(trim('MBTI')),
                'category_id' => 12,
            ],[
                'name' => trim('Development center / Desenvolvimento de potencial '),
                'slug' => Str::slug(trim('Development center / Desenvolvimento de potencial ')),
                'category_id' => 12,
            ],[
                'name' => trim('Retenção'),
                'slug' => Str::slug(trim('Retenção')),
                'category_id' => 12,
            ],[
                'name' => trim('Plano de sucessão '),
                'slug' => Str::slug(trim('Plano de sucessão ')),
                'category_id' => 12,
            ],[
                'name' => trim('Sistema'),
                'slug' => Str::slug(trim('Sistema')),
                'category_id' => 12,
            ],[
                'name' => trim('young / High / Top Potencial '),
                'slug' => Str::slug(trim('young / High / Top Potencial ')),
                'category_id' => 12,
            ],[

            //HRIS
                'name' => trim('SAP'),
                'slug' => Str::slug(trim('SAP')),
                'category_id' => 13,
            ],[
                'name' => trim('Sênior'),
                'slug' => Str::slug(trim('Sênior')),
                'category_id' => 13,
            ],[
                'name' => trim('Totus '),
                'slug' => Str::slug(trim('Totus ')),
                'category_id' => 13,
            ],[
                'name' => trim('Automatização de processos'),
                'slug' => Str::slug(trim('Automatização de processos')),
                'category_id' => 13,
            ],[

            //Comunicação Interna / Externa 
                'name' => trim('Assesoria de Imprensa '),
                'slug' => Str::slug(trim('Assesoria de Imprensa ')),
                'categoy_id' => 7
            ],[

                'name' => trim('TV Corporativa '),
                'slug' => Str::slug(trim('TV Corporativa ')),
                'categoy_id' => 7
            ],[

                'name' => trim('Jornal'),
                'slug' => Str::slug(trim('Jornal')),
                'categoy_id' => 7
            ],[

                'name' => trim('Revista'),
                'slug' => Str::slug(trim('Revista')),
                'categoy_id' => 7
            ],[

                'name' => trim('Campanha'),
                'slug' => Str::slug(trim('Campanha')),
                'categoy_id' => 7
            ],[

                'name' => trim('Social / comunidade'),
                'slug' => Str::slug(trim('Social / comunidade')),
                'categoy_id' => 7
            ],[

                'name' => trim('Branding '),
                'slug' => Str::slug(trim('Branding ')),
                'categoy_id' => 7
            ],[

                'name' => trim('redes sociais'),
                'slug' => Str::slug(trim('redes sociais')),
                'categoy_id' => 7
            ],[

                'name' => trim('vídeos corporativos'),
                'slug' => Str::slug(trim('vídeos corporativos')),
                'categoy_id' => 7
            ],[

                'name' => trim('rádio corporativa '),
                'slug' => Str::slug(trim('rádio corporativa ')),
                'categoy_id' => 7
            ],[

                'name' => trim('endomarketing '),
                'slug' => Str::slug(trim('endomarketing ')),
                'categoy_id' => 7
            ],[

                'name' => trim('brindes'),
                'slug' => Str::slug(trim('brindes')),
                'categoy_id' => 7
            ],[

                'name' => trim('eventos'),
                'slug' => Str::slug(trim('eventos')),
                'categoy_id' => 7
            ]
        ]);
    }
}
