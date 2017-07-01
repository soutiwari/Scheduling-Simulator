#include<bits/stdc++.h>
#define INF_MAX 99999
using namespace std;
struct process{
    int pno,arrival,execution,deadline;
    bool flag;
    int temparrival,tempdeadline,tempexecution;
};
struct processor
{
    int index[2000];
    float utlization;
    int k;
};
struct startend
{
    int start[2000];
    int end[2000];
    int k;
    int pno;
    char clock[2000];
};
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
int main(int arg, char* argv[])
{

    int nofprocess,nofprocessorf;
    char *filename;
    if(arg>1)
    {
        filename = argv[1];
      //  cout<<filename;
    }
    else{
        cout<<"no arguments";
        exit(1);
    }

    fstream file;

    file.open(filename,ios::in | ios::out);



    file>>nofprocess;
    file>>nofprocessorf;
    struct process p[nofprocess+1];

    for(int i=0;i<nofprocess;i++)
    {
        //cin>>p[i].pno>>p[i].arrival>>p[i].execution>>p[i].deadline;
        p[i].pno = i+1;
        file>>p[i].arrival;
        file>>p[i].execution;
        file>>p[i].deadline;
        p[i].temparrival=p[i].arrival;
        p[i].tempdeadline=p[i].deadline+p[i].arrival;
        p[i].tempexecution=p[i].execution;
        p[i].flag=false;
    }
    int nofprocessor;
    if(nofprocessorf>nofprocess)
    nofprocessor=nofprocess;
    else
    nofprocessor=nofprocessorf;
    //struct process p[nofprocess+1];
    struct processor proc[nofprocessor];
    qsort(p,nofprocess,sizeof(process),cmpfunc);
    for(int i=0;i<nofprocessor;i++)
    {
        proc[i].utlization=0;
        proc[i].k=0;
    }
    for(int i=0;i<nofprocessor;i++)
    {
        proc[i].utlization=(float)(p[i].execution)/(float)(p[i].deadline);
        proc[i].index[proc[i].k]=i;
        proc[i].k=1;
    }
    for(int i=nofprocessor;i<nofprocess;i++)
    {
        float min=INF_MAX;
        int processorindex=0;
        for(int j=0;j<nofprocessor;j++)
        {
            if(min>proc[j].utlization)
            {
                min=proc[j].utlization;
                processorindex=j;
            }
        }
        float util=(float)(p[i].execution)/(float)(p[i].deadline);
        proc[processorindex].utlization=proc[processorindex].utlization+util;
        proc[processorindex].index[proc[processorindex].k]=i;
        proc[processorindex].k++;
    }
    struct process **plist=new process *[nofprocessor];
    for(int i=0;i<nofprocessor;i++)
        plist[i]=new process[nofprocess+1];
   struct startend st[nofprocess+1];
    for(int i=0;i<nofprocessor;i++)
    {
        int temp=proc[i].k;
        for(int j=0;j<proc[i].k;j++)
        {
            plist[i][j].arrival=p[proc[i].index[j]].arrival;
            plist[i][j].deadline=p[proc[i].index[j]].deadline;
            plist[i][j].execution=p[proc[i].index[j]].execution;
            plist[i][j].pno=p[proc[i].index[j]].pno;
            plist[i][j].temparrival=p[proc[i].index[j]].temparrival;
            plist[i][j].tempdeadline=p[proc[i].index[j]].tempdeadline;
            plist[i][j].tempexecution=p[proc[i].index[j]].tempexecution;
            plist[i][j].flag=false;
            st[ plist[i][j].pno].k=0;
        }
    }
    lcm(p,nofprocess);
    cout<<hyperperiod<<endl;
    for(int i=0;i<=nofprocess;i++)
            {
                for(int j=0;j<=hyperperiod;j++)
                {
                    st[i].clock[j]='_';
                }
            }
    for(int l=0;l<nofprocessor;l++)
    {
        int clock=0;
        int hyper=hyperperiod;
        if(proc[l].utlization<1)
        {
            int temp=proc[l].k;
            qsort(plist[l],temp,sizeof(process),cmpfunc);
        while(hyper>=clock)
        {
            if(plist[l][0].arrival<=clock)
            {
                plist[l][0].tempexecution--;
                if(clock==plist[l][0].arrival)
                {
                    st[plist[l][0].pno].clock[clock]='#';
                }
                else
                {
                    st[plist[l][0].pno].clock[clock]='*';
                    if(st[plist[l][0].pno].clock[plist[l][0].arrival]!='#')
                    st[plist[l][0].pno].clock[plist[l][0].arrival]='|';
                }
                if(plist[l][0].flag==false)
                {
                    st[plist[l][0].pno].start[st[plist[l][0].pno].k]=clock;
                    plist[l][0].flag=true;
                }
                if(plist[l][0].tempexecution==0)
                {
                    plist[l][0].arrival=plist[l][0].arrival+plist[l][0].deadline;
                    plist[l][0].tempdeadline=plist[l][0].deadline+plist[l][0].tempdeadline;
                    plist[l][0].tempexecution=plist[l][0].execution;
                    plist[l][0].temparrival=plist[l][0].arrival;
                    st[plist[l][0].pno].end[st[plist[l][0].pno].k]=clock;
                    st[plist[l][0].pno].k++;
                    plist[l][0].flag=false;
                }
            }
            clock++;
            for(int i=0;i<temp;i++)
            {
                if(plist[l][i].arrival<=clock)
                {
                    plist[l][i].temparrival=0;
                }
            }
            qsort(plist[l],temp,sizeof(process),cmpfunc);
        }
        }
    }
    /*for(int i=1;i<nofprocess+1;i++)
        {
        cout<<"process "<<i<<endl;
        for(int j=0;j<st[i].k;j++)
            {
                cout<<st[i].start[j]<<" "<<++st[i].end[j]<<endl;
            }
        }*/

   /*for(int i=1;i<=nofprocess;i++)
        {
            for(int j=0;j<=hyperperiod;j++)
            {
                cout<<st[i].clock[j]<<" ";
            }
            cout<<endl<<endl;
        }*/
        for(int i=0;i<nofprocessor;i++)
        {
            cout<<"Processor "<<i+1<<endl;
            for(int j=0;j<proc[i].k;j++)
            {
                cout<<"Task-"<<p[proc[i].index[j]].pno<<endl;
                for(int m=0;m<hyperperiod;m++)
                    cout<<st[p[proc[i].index[j]].pno].clock[m];
                    cout<<endl;
            }
        }
    return 0;
}

