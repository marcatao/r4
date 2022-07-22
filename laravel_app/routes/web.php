<?php


Auth::routes();

Route::get('/', 'AdminController@index')->name('admin_index');
Route::get('/sistema', 'AdminController@index')->name('admin_index');
Route::get('/home', 'AdminController@index')->name('admin_index');   

Route::get('/admin_index_professor', 'AdminController@admin_index_professor')->name('admin_index_professor');
Route::get('/admin_index_aluno', 'AdminController@admin_index_aluno')->name('admin_index_aluno');

Route::get('/lista-provisionamento', 'AdminController@provisionamento_lista')->name('provisionamento_lista');
Route::post('/save-provisionamento', 'AdminController@provisionamento_save')->name('provisionamento_save');
Route::post('/load-provisionamento', 'AdminController@provisionamento_load')->name('provisionamento_load');
Route::post('/delete-provisionamento', 'AdminController@provisionamento_delete')->name('provisionamento_delete');
Route::get('/admin_provisionamento_form', 'AdminController@admin_provisionamento_form')->name('admin_provisionamento_form');
Route::get('/seleciona_aula', 'AdminController@seleciona_aula')->name('seleciona_aula');
Route::get('/seleciona_aluno', 'AdminController@seleciona_aluno')->name('seleciona_aluno');

Route::get('/index-massagista', 'AdminController@index_massagista')->name('admin_index_massagista');

Route::get('/admin-users', 'AdminController@admin_users')->name('admin-users');
Route::get('/form-user/{id}', 'AdminController@form_user')->name('form-user');
Route::post('/form-user/{id}', 'AdminController@form_user_save')->name('form-user');
Route::get('/admin-users-del/{id}', 'AdminController@admin_users_del')->name('admin-users-del');


Route::get('/admin-aulas', 'AdminController@admin_aulas')->name('admin-aulas');
Route::get('/form-aulas/{id}', 'AdminController@form_aulas')->name('form-aulas');
Route::post('/form-aulas/{id}', 'AdminController@form_aulas_save')->name('form-aulas');
Route::get('/admin-aulas-del/{id}', 'AdminController@admin_aulas_del')->name('form-aulas-del');

Route::get('/admin-relatorio-professores', 'AdminController@admin_relatorio_professores')->name('admin-relatorio-professores');
Route::get('/admin-relatorio-alunos', 'AdminController@admin_relatorio_alunos')->name('admin-relatorio-alunos');


Route::get('/admin-massagistas', 'AdminController@admin_massagistas')->name('admin-massagistas');
Route::get('/form-massagistas/{id}', 'AdminController@form_massagistas')->name('form-massagistas');
Route::post('/form-massagistas/{id}', 'AdminController@form_massagistas_save')->name('form-massagistas');
Route::get('/admin-massagistas-del/{id}', 'AdminController@admin_massagistas_del')->name('form-massagistas-del');

Route::get('/admin-produtos', 'AdminController@admin_produtos')->name('admin-produtos');
Route::get('/form-produtos/{id}', 'AdminController@form_produtos')->name('form-produtos');
Route::post('/form-produtos/{id}', 'AdminController@form_produtos_save')->name('form-produtos');
Route::get('/admin-produtos-del/{id}', 'AdminController@admin_produtos_del')->name('form-produtos-del');

Route::get('/admin-calendario', 'AdminController@admin_calendario')->name('admin-calendario');

Route::get('/admin-operacao-form-1', 'AdminController@admin_operacao_form_1')->name('operacao-form-1');
Route::get('/admin-lista-armarios-disponiveis', 'AdminController@admin_lista_armarios_disponiveis')->name('lista-armarios-disponiveis');
Route::get('/admin-armario-model', 'AdminController@armario_model')->name('armario-model');
Route::get('/admin-confirma-abrir-armario', 'AdminController@confirma_abrir_armario')->name('confirma-abrir-armario');
Route::get('/admin-abrir-armario', 'AdminController@abrir_armario')->name('abrir-armario');
Route::get('/admin-lista_operacoes_abertas', 'AdminController@lista_operacoes_abertas')->name('lista_operacoes_abertas');
Route::get('/encerra-sessao-massagem', 'AdminController@encerra_sessao_massagem')->name('encerra-sessao-massagem');





Route::get('/admin-operacao-form-2', 'AdminController@admin_operacao_form_2')->name('operacao-form-2');
Route::get('/admin-lista-armarios-indisponiveis', 'AdminController@admin_lista_armarios_indisponiveis')->name('lista-armarios-indisponiveis');
Route::get('/admin-armario-model-aberto', 'AdminController@armario_model_aberto')->name('armario-model-aberto');
Route::get('/admin-abrir-armario-aberto', 'AdminController@abrir_armario_aberto')->name('abrir-armario-aberto');
Route::get('/admin-lista-armarios-todos', 'AdminController@admin_lista_armarios_todos')->name('lista-armarios-todos');


Route::get('/admin-lista-produtos-disponiveis', 'AdminController@lista_produtos_disponiveis')->name('lista-produtos-disponiveis');
Route::get('/admin-produto-model', 'AdminController@produto_model')->name('produto-model');
Route::get('/admin-form-quantidade-produto', 'AdminController@form_quantidade_produto')->name('form-quantidade-produto');
Route::get('/admin-form-adiciona-produto', 'AdminController@form_adiciona_produto')->name('form-adiciona-produto');

Route::get('/admin-lista-massagista-disponiveis', 'AdminController@lista_massagista_disponiveis')->name('lista-massagista-disponiveis');
Route::get('/admin-massagista-model', 'AdminController@massagista_model')->name('massagista-model');
Route::get('/admin-form-adiciona-massagista', 'AdminController@form_adiciona_massagista')->name('form-adiciona-massagista');
Route::get('/admin-inclui-massagista-operacao-item', 'AdminController@inclui_massagista_operacao_item')->name('inclui-massagista-operacao-item');

Route::get('/admin-excluir_produto_operacao', 'AdminController@excluir_produto_operacao')->name('excluir_produto_operacao');

Route::get('/admin-operacao-form-3', 'AdminController@admin_operacao_form_3')->name('operacao-form-3');
Route::get('/admin-consulta-armario-aberto', 'AdminController@consulta_armario_aberto')->name('consulta-armario-aberto');
Route::get('/admin-consultar_operacao_valor', 'AdminController@consultar_operacao_valor')->name('consultar_operacao_valor');
Route::get('/admin-encerra-operacao', 'AdminController@encerra_operacao')->name('encerra-operacao');
Route::get('/admin-reabre-operacao', 'AdminController@reabre_operacao')->name('reabre-operacao');
Route::get('/admin-itens-da-operacao', 'AdminController@admin_itens_da_operacao')->name('admin-itens-da-operacao');

Route::get('/admin-imprimir/{id}', 'AdminController@imprimir')->name('imprimir');
Route::get('/admin-relatorio-operacao', 'AdminController@admin_relatorio_operacao')->name('admin-relatorio-operacao');
Route::get('/admin-relatorio-armarios', 'AdminController@admin_relatorio_armarios')->name('admin-relatorio-armarios');
Route::get('/admin-relatorio-massagistas', 'AdminController@admin_relatorio_massagistas')->name('admin-relatorio-massagistas');
Route::get('/admin-relatorio-operacao-detalhe', 'AdminController@admin_relatorio_operacao_detalhe')->name('admin-relatorio-operacao-detalhe');
Route::get('/admin-relatorio-operacao-resumo', 'AdminController@admin_relatorio_operacao_resumo')->name('admin-relatorio-operacao-resumo');

Route::get('/edicao-agendamento-massagem', 'AdminController@edicao_agendamento_massagem')->name('edicao-agendamento-massagem');
Route::get('/edicao-agendamento-massagem-save/{id}', 'AdminController@edicao_agendamento_massagem_save')->name('edicao-agendamento-massagem-save');

Route::get('/entrada-agendamento-operacao', 'AdminController@entrada_agendamento_operacao')->name('entrada-agendamento-operacao');


