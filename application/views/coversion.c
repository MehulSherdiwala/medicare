#include<stdio.h>
#include<string.h>
#include<stdlib.h>

int  main(){
	char a[10],num[100][30],ch[5],ch2[5];
	int i,j,k,real=0,decimal=0;
	int m,p,len,n=0,realLen=0;

	strcpy(num[1],"one");
	strcpy(num[2] ,"two");
	strcpy(num[3] ,"three");
	strcpy(num[4] ,"four");
	strcpy(num[5] ,"five");
	strcpy(num[6] ,"six");
	strcpy(num[7] ,"seven");
	strcpy(num[8] ,"eight");
	strcpy(num[9] ,"nine");
	strcpy(num[10], "ten");
	strcpy(num[11], "eleven");
	strcpy(num[12], "twelve");
	strcpy(num[13], "thirteen");
	strcpy(num[14], "fourteen");
	strcpy(num[15], "fifteen");
	strcpy(num[16], "sixteen");
	strcpy(num[17], "seventeen");
	strcpy(num[18], "eighteen");
	strcpy(num[19], "nineteen");
	strcpy(num[20], "twenty");
	strcpy(num[30], "thirty");
	strcpy(num[40], "forty");
	strcpy(num[50], "fifty");
	strcpy(num[60], "sixty");
	strcpy(num[70], "seventy");
	strcpy(num[80], "eighty");
	strcpy(num[90], "ninety");

	printf("Enter Decimal No : ");
	fgets(a,10,stdin);
	len=strlen(a);

	for(i=0;a[i]!= '.';i++){
		realLen++;
	}

	if(realLen > 5){
		printf("\nInvalid No ");
		exit(0);
	}

	if(realLen > 3){
		if(realLen == 5){
			n=1;
			ch[0]=a[0];
			ch[1]=a[1];
			m=atoi(ch);
			if(m <=20){
				printf("%s Thousand ",num[m]);
			} else {
				real = m%10;
				m=(m/10)*10;
				printf("%s %s Thousand ",num[m],num[real]);
			}
		} else {
			ch[0]=a[0];
			m=atoi(ch);

			printf("%s Thousand ",num[m]);
		}

	}

	if(realLen > 2 ){
		n++;
		ch2[0]=a[n];
		m=atoi(ch2);
		printf("%s Hundred ",num[m]);
	}

	if (realLen > 0){
		if(realLen == 1){
			n++;
			ch[0]=a[n];
			m=atoi(ch);
			printf("%s ",num[m]);
		} else {
			n++;
			ch[0]=a[n];
			ch[1]=a[n+1];
			m=atoi(ch);
			if(m <=20){
				printf("%s ",num[m]);
			} else {
				real = m%10;
				m=(m/10)*10;
				printf("%s %s ",num[m],num[real]);
			}
			n++;
		}
	}

	for (i=realLen+1;i<len-1;i++){
		decimal++;
	}

	n=realLen;
	printf("rupees and ");
	if(decimal == 1){
		n++;
		ch[0]=a[n];
		m=atoi(ch);
		printf("%s paise",num[m]);

	} else if(decimal == 2){
		n++;
		ch[0]=a[n];
		ch[1]=a[n+1];
		m=atoi(ch);

		if(m <=20){
			printf("%s paise",num[m]);
		} else {
			real = m%10;
			m=(m/10)*10;

			printf("%s %s paise",num[m],num[real]);
		}
	}


	return 0;

}
