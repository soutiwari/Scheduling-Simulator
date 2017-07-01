#include<bits/stdc++.h>
using namespace std;
struct process
{
    int arrival,pno,execution;
    int start;
    int end;
};
int cmpfunc(const void *a_, const void *b_)
{
    process *a = (process *)a_;
     process *b = (process *)b_;
    if (a->arrival < b->arrival) return -1;
    if (a->arrival > b->arrival) return 1;
    if (a->execution < b->execution) return -1;
    if (a->execution > b->execution) return 1;
    return 0;
}
int main(int arg,char* argv[])
{
    char *filename;
    if(arg>1)
    {
        filename = argv[1];
        //cout<<filename;
    }
    else{
        cout<<"No Input";
        exit(1);
    }

    fstream file;

    file.open(filename,ios::in | ios::out);

    int n;
    file>>n;
    process p[n];
    for(int i=0;i<n;i++)
    {
        p[i].pno = i+1;
        file>>p[i].arrival;
        file>>p[i].execution;
    }
    qsort(p,n,sizeof(process),cmpfunc);
     char time_clock[n+1][2000];
    int clock=0;
    int flag=0;
    while(flag<n)
    {
    //cout<<"hello"<<endl;
        if(p[0].arrival<=clock)
        {
            p[0].start=clock;
            p[0].end=clock+p[0].execution;
            p[0].temparrival=INF_MAX;
            clock=p[0].end;
        }
        else if(p[0].arrival>clock)
        {
            p[0].start=p[0].arrival;
            clock=p[0].arrival;
            p[0].end=clock+p[0].execution;
            clock=p[0].end;
            p[0].temparrival=INF_MAX;
        }
        for(int i=1;i<n;i++)
        {
            if(p[i].arrival<clock && p[i].temparrival!=INF_MAX)
                p[i].temparrival=0;
        }
        //cout<<p[0].pno<<" "<<p[0].arrival<<" "<<p[0].temparrival<<" "<<p[0].start<<" "<<p[0].end<<" "<<clock<<endl<<endl;
        qsort(p,n,sizeof(process),cmpfunc);
        //for(int i=0;i<n;i++)
            //cout<<p[0].pno<<" "<<p[0].arrival<<" "<<p[0].temparrival<<" "<<p[0].start<<" "<<p[0].end<<" "<<clock<<endl<<endl;
        flag++;
    }
    for(int i=0;i<n;i++)
    {
        //cout<<p[i].pno<<endl;
        if(i==0)
        {
            for(int j=0;j<p[i].start;j++)
                time_clock[p[i].pno][j]='_';
            for(int j=p[i].start;j<p[i].end;j++)
                time_clock[p[i].pno][j]='*';
            for(int j=p[i].end;j<=clock;j++)
                time_clock[p[i].pno][j]='_';
            //time_clock[p[i].pno][p[i].arrival]='|';
        }
        else
        {
            for(int j=0;j<=p[i].start;j++)
                time_clock[p[i].pno][j]='_';
            for(int j=p[i].start;j<p[i].end;j++)
                time_clock[p[i].pno][j]='*';
            for(int j=p[i].end;j<=clock;j++)
                time_clock[p[i].pno][j]='_';
            //time_clock[p[i].pno][p[i].arrival]='|';
        }
    }
    for(int i=1;i<=n;i++)
    {
        for(int j=0;j<=clock;j++)
            cout<<time_clock[i][j];
        cout<<endl;
    }
    int response[n+1];
    for(int i=0;i<n;i++)
    {
        response[p[i].pno]=p[i].end-p[i].arrival;
    }
    for(int i=1;i<=n;i++)
    {
        cout<<"Response time for process-"<<i<<" :"<<response[i]<<endl;
    }
}

