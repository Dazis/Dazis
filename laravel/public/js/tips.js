var returnCode = {
	GOON:'100', //���������Լ���
	OK:'200', //�ɹ�
	NOT_FOUND:'404', //û�в�ѯ����Ϣ
	NOT_ALLOW:'405', //�˲���������
	WRONG_PARAMS:'450', //�����������
	ACCOUNT_EXIST:'451', //�˺��Ѵ���
	ACCOUNT_NOT_ALLOW:'452', //�˺Ų����Ϲ淶
	ACCOUNT_LOCKED:'453', //������˺ű�����
	ACCOUNT_INACTIVE:'454', //�˺�δ�����ʱ����ʹ��
	NICK_EXIST:'455', //�ǳ��Ѵ���
	NICK_NOT_ALLOW:'456', //�ǳƲ��Ϲ淶
	NICK_NO_CHANGE:'457', //���û������޸��ǳ�
	CAPTCHA_WRONG:'458', //��֤�����
	PSW_WRONG:'459', //�������
	PSW_NOT_ALLOW:'460', //���벻�Ϲ淶
	MOBILE_WRONG:'461', //�ֻ��Ŵ���
	MOBILE_HAVE_BIND:'462', //�û��Ѿ������ֻ���
	MOBILE_OTHER_BIND:'463', //�ֻ����Ѿ��������˺Ű�
	MOBILE_CANT_UNBIND:'464', //�ֻ�ע����˺Ų��ܽ��
	SIG_WRONG:'465', //�ӿڵ�ǩ������
	ID_WRONG:'466', //��������У����Ϣ����
	DPSW_WRONG:'467', //��̬�������
	CAPTCHA_NEED:'468', //�˲�����Ҫ�ṩ��֤��
	HUDUN_NEED:'469', //�˲�����Ҫ���ܶ�̬����
	OLD_EMAIL_WRONG : '470', //�ɰ��������
	OLD_ANSWER_WRONG : '471', //���ܱ�����𰸴���
	IP_LOCKED: '472', //IP������
	EMAIL_WRONG:'420',
	SERIAL_NUM_WRONG : '474', //���кŴ���
	HUDUN_NOT_BIND : '476',
	USER_LOGIN_FORBIDDEN : '477', //�û���ֹ��¼
	BIND_EMAIL_WRONG : '478', //���������
	BIND_EMAIL_SELF : '479',  //���ܰ��Լ�
	MOBILE_EXIST: '480',	//���ֻ����ѱ�ע��
	INTERNAL_ERROR:'500' //�ڲ�����������		
};