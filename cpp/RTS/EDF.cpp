#include<bits/stdc++.h>
using namespace std;
struct process{
    int pno,arrival,deadline,execution;
    bool flag;
    int temparrival,tempdeadline,tempexecution;
};
struct startend{
    int start[2000];
    int end[2000];
    int k;
    int pno;
    char clock[2000];
};
int hyperperiod=1;
int gcd(int a,int b) {

   if(b == 0)
      return a;
   else return gcd(b,a%b);
}

void lcm(struct process l[], int n) {

    if(n == 0) return;
    hyperperiod = hyperperiod*l[n-1].deadline/ gcd(hyperperiod, l[n-1].deadline);
    lcm(l, n-1);
}
int cmpfunc(const void *a_, const void *b_)
{
    process *a = (process *)a_;
     process *b = (process *)b_;
    if (a->temparrival < b->temparrival) return -1;
    if (a->temparrival > b->temparrival) return 1;
    if (a->tempdeadline < b->tempdeadline) return -1;
    if (a->tempdeadline > b->tempdeadline) return 1;
    return 0;
}
int main(int arg, char* argv[])
{
    char *filename;
    if(arg>1)
    {
        filename = argv[1];
        //cout<<filename;
    }
    else{
        cout<<"no input";
        exit(1);
    }

    fstream file;

    file.open(filename,ios::in | ios::out);

    int n;
    file>>n;
    struct process p[n+1];
    struct startend s[n+1];
    for(int i=0;i<n;i++)
    {
        p[i].pno = i+1;
        file>>p[i].arrival;
        file>>p[i].execution;
        file>>p[i].deadline;
        //cin>>p[i].pno>>p[i].arrival>>p[i].execution>>p[i].deadline;
        p[i].temparrival=p[i].arrival;
        p[i].tempdeadline=p[i].deadline+p[i].arrival;
        p[i].tempexecution=p[i].execution;
        p[i].flag=false;
        s[i].k=0;
    }
    s[n].k=0;
    float sum=0;
    int clock=0;
    for(int i=0;i<n;i++)
    {
        sum+=(float)p[i].execution/p[i].deadline;
    }
    cout<<sum<<endl;
    if(sum<=1)
    {
        qsort(p,n,sizeof(process),cmpfunc);
       /* cout<<"clock-"<<clock<<endl;
        for(int i=0;i<n;i++)
            cout<<p[i].pno<<" "<<p[i].temparrival<<" "<<p[i].tempexecution<<" "<<p[i].tempdeadline<<endl;
            cout<<endl<<endl;*/
        lcm(p,n);

       // cout<<"hyperperoid";
        cout<<hyperperiod<<endl;
        for(int i=0;i<=n;i++)
        {
            for(int j=0;j<=hyperperiod;j++)
            {
                s[i].clock[j]='_';
            }
        }
        while(hyperperiod>=clock)
        {
            if(p[0].arrival<=clock)
            {
                p[0].tempexecution--;
                if(clock==p[0].arrival)
                {
                    s[p[0].pno].clock[clock]='#';
                }
                else
                {
                    s[p[0].pno].clock[clock]='*';
                    if(s[p[0].pno].clock[p[0].arrival]!='#')
                    s[p[0].pno].clock[p[0].arrival]='|';
                }
                if(p[0].flag==false)
                {
                    s[p[0].pno].start[s[p[0].pno].k]=clock;
                    p[0].flag=true;
                }
                if(p[0].tempexecution==0)
                {
                    p[0].arrival=p[0].arrival+p[0].deadline;
                    p[0].tempdeadline=p[0].deadline+p[0].tempdeadline;
                    p[0].tempexecution=p[0].execution;
                    p[0].temparrival=p[0].arrival;
                    s[p[0].pno].end[s[p[0].pno].k]=clock;
                    s[p[0].pno].k++;
                    p[0].flag=false;
                }
            }
            clock++;
            for(int i=0;i<n;i++)
            {
                if(p[i].arrival<=clock)
                {
                    p[i].temparrival=0;
                }
            }
            //cout<<"clock-"<<clock<<endl;
            qsort(p,n,sizeof(process),cmpfunc);
            /*for(int i=0;i<n;i++)
            cout<<p[i].pno<<" "<<p[i].temparrival<<" "<<p[i].tempexecution<<" "<<p[i].tempdeadline<<endl;
            cout<<endl<<endl;*/
        }
       /* for(int i=1;i<n+1;i++)
        {
        cout<<"process "<<i<<endl;
        for(int j=0;j<s[i].k;j++)
            {
                //cout<<s[i].start[j]<<" Hello"<<endl;
                cout<<s[i].start[j]<<" "<<++s[i].end[j]<<endl;
            }
        }
        cout<<endl<<endl;*/
        for(int i=1;i<=n;i++)
        {
            for(int j=0;j<=hyperperiod;j++)
            {
                cout<<s[i].clock[j];
            }
            cout<<endl;
        }
    }
}
